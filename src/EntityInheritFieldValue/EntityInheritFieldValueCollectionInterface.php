<?php

namespace Drupal\entity_inherit\EntityInheritFieldValue;

/**
 * A colleciton of field values and their previous values.
 */
interface EntityInheritFieldValueCollectionInterface extends EntityInheritFieldValueInterface {

  /**
   * Add items to the collection.
   *
   * @param \Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritFieldValueInterface $items
   *   Items to add.
   */
  public function add(EntityInheritFieldValueInterface $items);

}
