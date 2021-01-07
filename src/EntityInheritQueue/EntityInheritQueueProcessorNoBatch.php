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
    while ($next = $this->queue->next()) {
      print_r([__LINE__, $next, '----> Processing ' . $next['id']]);
    }
  }

}
