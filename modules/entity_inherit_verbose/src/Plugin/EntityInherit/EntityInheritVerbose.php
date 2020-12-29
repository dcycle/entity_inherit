<?php

namespace Drupal\entity_inherit_verbose\Plugin\EntityInheritPlugin;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritAction\EntityInheritActionInterface;
use Drupal\entity_inherit\EntityInheritPlugin\EntityInheritPluginBase;

/**
 * Displays verbose information every time a node is saved.
 *
 * @EntityInheritPluginAnnotation(
 *   id = "entity_inherit_plugin_verbose",
 *   description = @Translation("Displays verbose information every time a node is saved."),
 *   weight = 1,
 * )
 */
class EntityInheritVerbose extends EntityInheritPluginBase {

  /**
   * {@inheritdoc}
   */
  public function broadcastAction(EntityInheritActionInterface $action, EntityInherit $app) {
    $app->userStatusMessage($action->toTranslatedString());
  }

}
