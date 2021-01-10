<?php

namespace Drupal\entity_inherit\EntityInheritStorage;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingMultipleEntitiesInterface;

/**
 * Storage.
 */
class EntityInheritStorage implements EntityInheritStorageInterface {

  /**
   * The app singleton.
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $app;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The app singleton.
   */
  public function __construct(EntityInherit $app) {
    $this->app = $app;
  }

  /**
   * {@inheritdoc}
   */
  public function getChildrenOf(string $type, string $id) : EntityInheritExistingMultipleEntitiesInterface {
    $drupal_entities = [];

    foreach (array_keys($this->app->getParentEntityFields()->validOnly('parent')->toArray()) as $field) {
      $drupal_entities = array_merge($drupal_entities, $this->getReferencingEntities($field, $type, $id));
    }

    return $this->app->getEntityFactory()->newCollection($drupal_entities);
  }

  /**
   * Get all entities whose source field targets entity of specified type, id.
   *
   * @param string $source_field
   *   An entity's source field such as 'node.field_parents'.
   * @param string $target_type
   *   An entity's target type such as 'node' or 'paragraph'.
   * @param string $target_id
   *   An entity's target id such as '1' or '24161'.
   *
   * @return array
   *   Array of Drupal entities.
   */
  public function getReferencingEntities(string $source_field, string $target_type, string $target_id) : array {
    print_r([
      $source_field,
      $target_type,
      $target_id,
    ]);
    return $this->app->getEntityTypeManager()
      ->getListBuilder($target_type)
      ->getStorage()
      ->loadByProperties([
        $source_field => $target_id,
      ]);
  }

}
