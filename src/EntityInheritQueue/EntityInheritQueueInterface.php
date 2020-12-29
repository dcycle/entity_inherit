<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * A queue.
 */
interface EntityInheritQueueInterface {

  /**
   * Add entities to the queue.
   *
   * @param \Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableInterface $items
   *   The items to add.
   */
  public function add(EntityInheritQueueableInterface $items);

  /**
   * Get queuable items.
   *
   * @return \Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableInterface
   *   Items.
   */
  public function items() : EntityInheritQueueableInterface;

  /**
   * Process this queue.
   */
  public function process();

}
