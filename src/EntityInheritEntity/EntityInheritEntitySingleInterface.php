<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

/**
 * An single entity.
 */
interface EntityInheritEntitySingleInterface extends EntityInheritUpdatableEntityInterface, EntityInheritEntityRevisionInterface {

  /**
   * Get the type of this entity.
   *
   * @return string
   *   The type, for example 'node'.
   */
  public function getType() : string;

  /**
   * Check if we have a field.
   *
   * @param string $field
   *   A field name.
   *
   * @return bool
   *   TRUE if we have new parents.
   */
  public function hasField(string $field) : bool;

  /**
   * Check if we have new parents.
   *
   * @return bool
   *   TRUE if we have new parents.
   */
  public function hasNewParents() : bool;

  /**
   * Presave this entity.
   */
  public function presave();

}
