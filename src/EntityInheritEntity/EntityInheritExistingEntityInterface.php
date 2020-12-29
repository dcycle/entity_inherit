<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

use Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritFieldValueCollectionInterface;

/**
 * An entity which can be updated based on its parents.
 */
interface EntityInheritExistingEntityInterface {

  /**
   * Get all field values along with their previous values.
   *
   * @return \Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritFieldValueCollectionInterface
   *   Field values.
   */
  public function fieldValues() : EntityInheritFieldValueCollectionInterface;

}
