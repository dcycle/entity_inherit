<?php

namespace Drupal\entity_inherit\Plugin\EntityInheritPlugin;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritPlugin\EntityInheritPluginBase;

/**
 * Alter a list of parent fields in legacy (1.0.0-beta5 or before format).
 *
 * @EntityInheritPluginAnnotation(
 *   id = "entity_inherit_alter_parent_fields_legacy",
 *   description = @Translation("Alter a list of parent fields."),
 *   weight = -100,
 * )
 */
class EntityInheritAlterFieldsLegacyFormat extends EntityInheritPluginBase {

  /**
   * {@inheritdoc}
   */
  public function alterFields(array &$field_names, EntityInherit $app) {
    foreach ($field_names as $key => $field_name) {
      if (strpos($field_name, '.') === FALSE) {
        $field_names[$key] = 'node.' . $field_name;
      }
    }
  }

}
