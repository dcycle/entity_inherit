<?php

namespace Drupal\entity_inherit\EntityInheritPlugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritAction\EntityInheritActionInterface;
use Drupal\entity_inherit\EntityInheritEntity\EntityInheritUpdatableEntityInterface;

/**
 * A base class to help developers implement EntityInheritPlugin objects.
 *
 * @see \Drupal\entity_inherit\Annotation\EntityInheritPluginAnnotation
 * @see \Drupal\entity_inherit\EntityInheritPlugin\EntityInheritPluginInterface
 */
abstract class EntityInheritPluginBase extends PluginBase implements EntityInheritPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function filterFields(array &$field_names, array $original, string $category, EntityInherit $app) {}

  /**
   * {@inheritdoc}
   */
  public function presave(EntityInheritUpdatableEntityInterface $entity, EntityInherit $app) {}

  /**
   * {@inheritdoc}
   */
  public function broadcastAction(EntityInheritActionInterface $action, EntityInherit $app) {}

}