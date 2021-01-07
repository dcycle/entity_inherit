<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * A collection of queuable items.
 */
interface EntityInheritQueueableCollectionInterface extends EntityInheritQueueableInterface {

  /**
   * Add other items to this collection.
   *
   * @param \Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableInterface $items
   *   Items to add.
   */
  public function add(EntityInheritQueueableInterface $items);

  /**
   * Get the first queueable item, if possible.
   *
   * @return null|\Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableInterface
   *   The queueable item, or NULL.
   */
  public function first();

}
