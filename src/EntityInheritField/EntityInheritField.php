<?php

namespace Drupal\entity_inherit\EntityInheritField;

use Drupal\entity_inherit\EntityInherit;

/**
 * Reprensents a Drupal field.
 */
class EntityInheritField implements EntityInheritFieldInterface {

  /**
   * The EntityInherit singleton (service).
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $app;

  /**
   * The entity type to which this field belongs.
   *
   * @var string
   */
  protected $entityType;

  /**
   * The field name.
   *
   * @var string
   */
  protected $fieldName;

  /**
   * The field info from Drupal's field map.
   *
   * @var array
   */
  protected $fieldInfo;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The global app singleton.
   * @param string $entity_type
   *   Each field can only exist on a single entity type such as 'node'.
   * @param string $field_name
   *   A field name.
   * @param array $field_info
   *   A field info array from Drupal's field map.
   */
  public function __construct(EntityInherit $app, string $entity_type, string $field_name, array $field_info) {
    $this->app = $app;
    $this->entityType = $entity_type;
    $this->fieldName = trim($field_name);
    $this->fieldInfo = $field_info;
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return $this->entityType . '.' . $this->fieldName;
  }

  /**
   * {@inheritdoc}
   */
  public function entityType() : string {
    return $this->entityType;
  }

  /**
   * {@inheritdoc}
   */
  public function fieldName() : string {
    return $this->fieldName;
  }

  /**
   * {@inheritdoc}
   */
  public function matches(string $entity_type, string $field_name) : bool {
    return $this->fieldName == $field_name && $this->entityType == $entity_type;
  }

  /**
   * {@inheritdoc}
   */
  public function matchesString(string $field_string) : bool {
    $parts = explode('.', $field_string);

    if (count($parts) != 2) {
      return FALSE;
    }

    return $this->matches($parts[0], $parts[1]);
  }

  /**
   * {@inheritdoc}
   */
  public function validInheritable() : bool {
    return $this->app->validFieldName($this->entityType, $this->fieldName, 'inheritable');
  }

  /**
   * {@inheritdoc}
   */
  public function valid(string $category) : bool {
    return $this->app->validFieldName($this->entityType, $this->fieldName, $category);
  }

}
