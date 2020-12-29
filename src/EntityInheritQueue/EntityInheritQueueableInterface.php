<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * One or several queuable items.
 */
interface EntityInheritQueueableInterface {

  /**
   * Get as an array.
   *
   * @return array
   *   An array of single items.
   */
  public function toArray();

}
