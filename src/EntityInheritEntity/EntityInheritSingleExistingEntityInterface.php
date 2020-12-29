<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

/**
 * A single existing entity.
 */
interface EntityInheritSingleExistingEntityInterface {

  /**
   * Get a unique string which identifies this object.
   *
   * @return string
   *   A unique string.
   */
  public function toStorageId() : string;

}