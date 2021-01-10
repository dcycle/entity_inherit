<?php

namespace Drupal\entity_inherit\EntityInheritField;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\Utilities\FriendTrait;

/**
 * A factory to build fields. Instantiate through EntityEnherit.
 */
class EntityInheritFieldFactory {

  use FriendTrait;

  /**
   * The EntityInherit singleton (service).
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $app;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The application singleton.
   */
  public function __construct(EntityInherit $app) {
    $this->friendAccess([EntityInherit::class]);
    $this->app = $app;
  }

  /**
   * Get a field from a field id, if possible.
   *
   * @param string $id
   *   An id such as node.body.
   *
   * @return \Drupal\entity_inherit\EntityInheritField\EntityInheritFieldInterface
   *   A field.
   *
   * @throws \Exception
   */
  public function fromId(string $id) : EntityInheritFieldInterface {
    return $this->app->allFields()->filter([$id])->findById($id);
  }

  /**
   * Get a field list from a Drupal field map.
   *
   * @param array $map
   *   A field map as retrieved from the Drupal entityFieldManager's
   *   getFieldMap() method.
   *
   * @return \Drupal\entity_inherit\EntityInheritField\EntityInheritFieldListInterface
   *   A field list.
   */
  public function fromMap(array $map) : EntityInheritFieldListInterface {
    $return = new EntityInheritFieldList();
    foreach ($map as $type => $fields) {
      foreach ($fields as $name => $info) {
        $field = new EntityInheritField($this->app, $type, $name, $info);
        $return->add($field);
      }
    }
    return $return;
  }

}
