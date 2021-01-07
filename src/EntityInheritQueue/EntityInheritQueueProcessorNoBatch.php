<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * A queue processor for the command line.
 */
class EntityInheritQueueProcessorNoBatch extends EntityInheritQueueProcessor {

  /**
   * {@inheritdoc}
   */
  public function process() {
    while ($next = $this->queue->items()->first()) {
      print_r('----> Processing ' . $next);
    }
  }

}
