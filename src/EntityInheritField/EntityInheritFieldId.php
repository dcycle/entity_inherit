<?php

namespace Drupal\entity_inherit\EntityInheritField;

use Drupal\Core\Entity\EntityInterface;

/**
 * Reprensents a Drupal field ID.
 */
class EntityInheritFieldId {

  /**
   * A content type such as node.
   *
   * @var string
   */
  protected $entity_type;

  /**
   * A field name such as field_parents or body.
   *
   * @var string
   */
  protected $field_name;

  /**
   * Constructor.
   *
   * @param string $entity_type
   *   An entity type such as node.
   * @param string $field_name
   *   A field name such as field_parents or body.
   */
  public function __construct(string $entity_type, string $field_name) {
    $this->entity_type = $entity_type;
    $this->field_name = $field_name;
  }

  /**
   * Get the field name.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   A Drupal entity. Used to confirm that the
   *
   * @return string
   *   A field name.
   *
   * @throws \Exception
   *   An exception is thrown if the entity is not compatible with this
   *   field id.
   */
  public function fieldName(EntityInterface $entity) : string {
    if ($entity->getEntityTypeId() != $this->entity_type) {
      throw new \Exception('An entity of type ' . $entity->getEntityTypeId() . ' cannot have a field of type ' . $this->entity_type);
    }
    return $this->field_name;
  }

  /**
   * Check whether this field matches an entity type/name combination.
   *
   * @param string $entity_type
   *   An entity type such as node.
   * @param string $field_name
   *   A field name such as field_parents or body.
   *
   * @return bool
   *   TRUE if matches.
   */
  public function matches(string $entity_type, string $field_name) {
    return $this->field_name == $field_name && $this->entity_type == $entity_type;
  }

  /**
   * Return a unique ID for this field id as a string.
   *
   * @return string
   *   A unique ID such as "node.body".
   */
  public function uniqueId() : string {
    return $this->entity_type . '.' . $this->field_name;
  }

}
