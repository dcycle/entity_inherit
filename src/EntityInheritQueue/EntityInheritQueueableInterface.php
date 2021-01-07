<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * One or several queuable items.
 */
interface EntityInheritQueueableInterface {

  /**
   * Whether an entity id is in a queue.
   *
   * @param string $id
   *   An id such as node:1.
   *
   * @return bool
   *   Whether an entity id is in a queue.
   */
  public function containsId(string $id) : bool;

  /**
   * Get as an array.
   *
   * @return array
   *   An array of single items.
   */
  public function toArray();

}
