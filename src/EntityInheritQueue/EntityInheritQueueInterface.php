<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

use Drupal\entity_inherit\EntityInheritEntity\EntityInheritSingleExistingEntityInterface;

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
   * Whether an entity is in a queue.
   *
   * @param \Drupal\entity_inherit\EntityInheritEntity\EntityInheritSingleExistingEntityInterface $entity
   *   An entity.
   *
   * @return bool
   *   Whether an entity is in a queue.
   */
  public function contains(EntityInheritSingleExistingEntityInterface $entity) : bool;

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
