<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * A collection of queuable items.
 */
class EntityInheritQueueableCollection implements EntityInheritQueueableCollectionInterface, EntityInheritQueueableInterface {

  /**
   * The items.
   *
   * @var array
   */
  protected $items;

  /**
   * Constructor.
   *
   * @param array $items
   *   The initial items.
   */
  public function __construct(array $items = []) {
    $this->items = $items;
  }

  /**
   * {@inheritdoc}
   */
  public function add(EntityInheritQueueableInterface $items) {
    $this->items += $items->toArray();
  }

  /**
   * {@inheritdoc}
   */
  public function first() {
    return array_shift($this->items);
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() : array {
    return $this->items;
  }

}
