<?php

namespace Drupal\entity_inherit\EntityInheritPlugin;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritAction\EntityInheritActionInterface;
use Drupal\entity_inherit\EntityInheritEntity\EntityInheritUpdatableEntityInterface;

/**
 * An interface for all EntityInheritPlugin type plugins.
 */
interface EntityInheritPluginInterface {

  /**
   * Remove field names which should be ignored.
   *
   * @param array $field_names
   *   An array of field names which can be modified.
   * @param array $original
   *   An non-modified array of field names.
   * @param string $category
   *   Arbitrary category which is then managed by plugins. "inheritable" and
   *   "parent" can be used.
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The app singleton.
   */
  public function filterFields(array &$field_names, array $original, string $category, EntityInherit $app);

  /**
   * Act on an entity being saved.
   *
   * @param \Drupal\entity_inherit\EntityInheritEntity\EntityInheritUpdatableEntityInterface $entity
   *   An entity being presaved.
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The app singleton.
   */
  public function presave(EntityInheritUpdatableEntityInterface $entity, EntityInherit $app);

  /**
   * Broadcast an action to plugins.
   *
   * @param \Drupal\entity_inherit\EntityInheritAction\EntityInheritActionInterface $action
   *   An action being performed.
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The app singleton.
   */
  public function broadcastAction(EntityInheritActionInterface $action, EntityInherit $app);

}
