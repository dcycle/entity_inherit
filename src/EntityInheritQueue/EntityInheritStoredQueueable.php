<?php

namespace Drupal\entity_inherit\EntityInheritQueue;

/**
 * A queueable item.
 */
class EntityInheritStoredQueueable extends EntityInheritQueueable {

  /**
   * The id of the stored entity reference, for example node:1.
   *
   * @var string
   */
  protected $id;

  /**
   * Constructor.
   *
   * @param string $id
   *   The id of the stored entity reference, for example node:1.
   */
  public function __construct(string $id) {
    $this->id = $id;
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return [
      $this->id => $this,
    ];
  }

}
