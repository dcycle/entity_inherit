<?php

namespace Drupal\entity_inherit\EntityInheritStorage;

use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingMultipleEntitiesInterface;

/**
 * Storage.
 */
class EntityInheritStorage implements EntityInheritStorageInterface {

  /**
   * The app singleton.
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $app;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The app singleton.
   */
  public function __construct(EntityInherit $app) {
    $this->app = $app;
  }

  /**
   * {@inheritdoc}
   */
  public function getChildrenOf(string $type, string $id) : EntityInheritExistingMultipleEntitiesInterface {
    return $this->app->getEntityFactory()->newCollection();
  }

}
