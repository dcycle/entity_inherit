<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

/**
 * An entity which can be updated based on its parents.
 */
interface EntityInheritUpdatableEntityInterface {

  /**
   * Update this entity based on its parents.
   */
  public function update();

}
