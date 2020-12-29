<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * A queue processor.
 */
abstract class EntityInheritQueueProcessor implements EntityInheritQueueProcessorInterface {

  /**
   * The queue.
   *
   * @var \Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueInterface
   */
  protected $queue;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueInterface $queue
   *   The queue.
   */
  public function __construct(EntityInheritQueueInterface $queue) {
    $this->queue = $queue;
  }

}
