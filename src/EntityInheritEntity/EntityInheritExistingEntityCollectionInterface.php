<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

use Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableCollectionInterface;

/**
 * An existing single entity or group.
 */
interface EntityInheritExistingEntityCollectionInterface {

  /**
   * Get as an array.
   *
   * @return array
   *   Entities as an array.
   */
  public function toArray() : array;

  /**
   * Create queueable items.
   *
   * @return \Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableCollectionInterface
   *   Queuable items.
   */
  public function toQueueable() : EntityInheritQueueableCollectionInterface;

}
