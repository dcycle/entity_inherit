<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

use Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritSingleFieldValueInterface;

/**
 * An entity which can be new or existing, which can contain revisions.
 */
abstract class EntityInheritEntity extends EntityInheritEntityRevision implements EntityInheritUpdatableEntityInterface, EntityInheritEntitySingleInterface {

  /**
   * Check if a field should be applied.
   *
   * @param \Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritSingleFieldValueInterface $field_value
   *   A field value.
   *
   * @return bool
   *   TRUE if a field should be applied.
   */
  abstract public function applies(EntityInheritSingleFieldValueInterface $field_value) : bool;

  /**
   * Set a field value.
   *
   * @param string $field_name
   *   A field name.
   * @param array $value
   *   A field value.
   */
  public function set(string $field_name, array $value) {
    $drupal_entity = $this->getDrupalEntity();

    $drupal_entity->{$field_name} = $value;

    $this->drupalEntity = $drupal_entity;
  }

  /**
   * {@inheritdoc}
   */
  public function update() {
    foreach ($this->getMergedParents()->fieldValues()->toArray() as $field_value) {
      $this->updateField($field_value);
    }
  }

  /**
   * Update a field based on field values.
   *
   * @param \Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritSingleFieldValueInterface $field_value
   *   A field value.
   */
  public function updateField(EntityInheritSingleFieldValueInterface $field_value) {
    if ($this->applies($field_value)) {
      $this->set($field_value->fieldName(), $field_value->newValue());
    }
  }

}