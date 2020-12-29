<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * A queue.
 */
interface EntityInheritQueueProcessorInterface {

  /**
   * Process the queue associated to this processor.
   */
  public function process();

}
