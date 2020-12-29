<?php

namespace Drupal\entity_inherit\EntityInheritFieldValue;

use Drupal\entity_inherit\EntityInherit;

/**
 * A colleciton of field values and their previous values.
 */
class EntityInheritFieldValueCollection implements EntityInheritFieldValueCollectionInterface {

  /**
   * The app singleton.
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $app;

  /**
   * The field values.
   *
   * @var array
   */
  protected $fieldValues;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The app singleton.
   */
  public function __construct(EntityInherit $app) {
    $this->app = $app;
    $this->fieldValues = [];
  }

  /**
   * {@inheritdoc}
   */
  public function add(EntityInheritFieldValueInterface $items) {
    $this->fieldValues += $items->toArray();
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() : array {
    return $this->fieldValues;
  }

}
