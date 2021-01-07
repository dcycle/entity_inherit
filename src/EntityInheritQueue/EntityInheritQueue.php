<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritEntity\EntityInheritSingleExistingEntityInterface;
use Drupal\entity_inherit\Utilities\FriendTrait;

/**
 * A queue.
 */
class EntityInheritQueue implements EntityInheritQueueInterface {

  use FriendTrait;

  /**
   * The queueable items.
   *
   * @var \Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableCollection
   */
  protected $items;

  /**
   * The EntityInherit singleton (service).
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $app;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The application singleton.
   */
  public function __construct(EntityInherit $app) {
    $this->friendAccess([EntityInherit::class]);
    $this->app = $app;
    $this->items = new EntityInheritStoredQueueableCollection();
  }

  /**
   * {@inheritdoc}
   */
  public function add(EntityInheritQueueableInterface $items) {
    $this->items->add($items);
  }

  /**
   * {@inheritdoc}
   */
  public function contains(EntityInheritSingleExistingEntityInterface $entity) : bool {
    return $this->items->containsId($entity->toStorageId());
  }

  /**
   * {@inheritdoc}
   */
  public function items() : EntityInheritQueueableInterface {
    return $this->items;
  }

  /**
   * {@inheritdoc}
   */
  public function process() {
    $this->app->getQueueProcessorFactory()->processor($this)->process();
  }

}
