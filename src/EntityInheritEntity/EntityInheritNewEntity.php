<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritSingleFieldValueInterface;

/**
 * An entity.
 */
class EntityInheritNewEntity extends EntityInheritEntity {

  /**
   * {@inheritdoc}
   */
  public function applies(EntityInheritSingleFieldValueInterface $field_value) : bool {
    $field_name = $field_value->fieldName();

    return ($this->hasField($field_name) && $this->value($field_name) == []);
  }

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   A Drupal entity.
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The global app.
   */
  public function __construct(EntityInterface $entity, EntityInherit $app) {
    $this->drupalEntity = $entity;
    $this->app = $app;
  }

  /**
   * {@inheritdoc}
   */
  public function getDrupalEntity() : EntityInterface {
    return $this->drupalEntity;
  }

  /**
   * {@inheritdoc}
   */
  public function getMergedParents() : EntityInheritExistingMultipleEntitiesInterface {
    $return = $this->app->getEntityFactory()->newCollection();

    $fields = $this->app->getParentEntityFields()->validOnly('parent')->toArray();

    foreach ($fields as $field) {
      $return->add($this->referencedEntities($field));
    }

    return $return;
  }

  /**
   * {@inheritdoc}
   */
  public function hasNewParents() : bool {
    return count($this->getMergedParents()) >= 0;
  }

  /**
   * {@inheritdoc}
   */
  public function originalValue(string $field_name) : array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function presave() {
    foreach ($this->getMergedParents()->preload()->toArray() as $entity) {
      foreach ($entity->getFields() as $fieldname => $value) {
        if ($this->hasField($fieldname)) {
          $this->drupalEntity->{$fieldname} = $value;
        }
      }
    }
  }

}
