<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\Utilities\FriendTrait;

/**
 * A factory to build entities. Instantiate through EntityEnherit.
 */
class EntityInheritEntityFactory {

  use FriendTrait;

  /**
   * The EntityInherit singleton (service).
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $app;

  /**
   * Constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The application singleton.
   */
  public function __construct(EntityInherit $app) {
    $this->friendAccess([EntityInherit::class]);
    $this->app = $app;
  }

  /**
   * Get an entity from a type and id.
   *
   * @param string $type
   *   A type, for example "node".
   * @param string $id
   *   An id, for example "1".
   * @param null|\Drupal\Core\Entity\EntityInterface $entity
   *   The Drupal entity object, or NULL if we don't have it.
   *
   * @return \Drupal\entity_inherit\EntityInheritEntity\EntityInheritEntitySingleInterface
   *   An entity.
   */
  public function fromTypeIdEntity(string $type, string $id, $entity) : EntityInheritEntitySingleInterface {
    return new EntityInheritExistingEntity($type, $id, $entity, $this->app);
  }

  /**
   * Get an entity from a type and id.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   A Drupal entity.
   *
   * @return \Drupal\entity_inherit\EntityInheritEntity\EntityInheritEntitySingleInterface
   *   An entity.
   */
  public function fromEntity(EntityInterface $entity) : EntityInheritEntitySingleInterface {
    if ($entity->id()) {
      return $this->fromTypeIdEntity($entity->getEntityTypeId(), $entity->id(), $entity);
    }
    return new EntityInheritNewEntity($entity, $this->app);
  }

  /**
   * Get a new collection.
   *
   * @return \Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingMultipleEntitiesInterface
   *   A new collection.
   */
  public function newCollection() : EntityInheritExistingMultipleEntitiesInterface {
    return new EntityInheritExistingEntityCollection($this->app);
  }

}
