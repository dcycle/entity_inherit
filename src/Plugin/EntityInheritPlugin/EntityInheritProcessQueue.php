<?php

namespace Drupal\entity_inherit\Plugin\EntityInheritPlugin;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritEntity\EntityInheritUpdatableEntityInterface;
use Drupal\entity_inherit\EntityInheritPlugin\EntityInheritPluginBase;

/**
 * Processes a queue.
 *
 * Notice the weight 0, which means this is processed, as it needs to be,
 * after the EntityInheritChild and EntityInheritParent plugins have had their
 * chance to put entities in the queue.
 *
 * @EntityInheritPluginAnnotation(
 *   id = "entity_inherit_queue",
 *   description = @Translation("Processes a queue."),
 *   weight = 0,
 * )
 */
class EntityInheritProcessQueue extends EntityInheritPluginBase {

  /**
   * {@inheritdoc}
   */
  public function presave(EntityInheritUpdatableEntityInterface $entity, EntityInherit $app) {
    print_r([__FILE__]);
    $app->getQueue()->process();
  }

}
