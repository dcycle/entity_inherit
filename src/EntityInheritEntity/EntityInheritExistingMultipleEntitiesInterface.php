<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

/**
 * A group of existing entities.
 */
interface EntityInheritExistingMultipleEntitiesInterface extends EntityInheritExistingEntityCollectionInterface, EntityInheritReadableEntityInterface, \Countable {

  /**
   * Add items to the collection.
   *
   * @param \Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingEntityCollectionInterface $items
   *   Items to add.
   */
  public function add(EntityInheritExistingEntityCollectionInterface $items);

  /**
   * Get this collection with all items preloaded.
   *
   * @return \Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingMultipleEntitiesInterface
   *   Items to add.
   */
  public function preload() : EntityInheritExistingMultipleEntitiesInterface;

  /**
   * Remove items.
   *
   * @param \Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingMultipleEntitiesInterface $items
   *   Items to remove.
   *
   * @return \Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingMultipleEntitiesInterface
   *   New collection with removed items.
   */
  public function remove(EntityInheritExistingMultipleEntitiesInterface $items) : EntityInheritExistingMultipleEntitiesInterface;

}
