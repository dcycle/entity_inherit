<?php

namespace Drupal\entity_inherit\EntityInheritEntity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritSingleFieldValueInterface;
use Drupal\entity_inherit\EntityInheritFieldValue\EntityInheritFieldValueCollectionInterface;
use Drupal\entity_inherit\EntityInheritQueue\EntityInheritQueueableCollectionInterface;
use Drupal\entity_inherit\EntityInheritQueue\EntityInheritStoredQueueableCollection;
use Drupal\entity_inherit\EntityInheritQueue\EntityInheritStoredQueueable;

/**
 * An entity which preexists.
 */
class EntityInheritExistingEntity extends EntityInheritEntity implements EntityInheritSingleExistingEntityInterface, EntityInheritExistingEntityCollectionInterface, EntityInheritExistingEntityInterface {

  use StringTranslationTrait;

  /**
   * The Drupal entity id.
   *
   * @var string
   */
  protected $id;

  /**
   * Constructor.
   *
   * @param string $type
   *   The Drupal entity type such as "node".
   * @param string $id
   *   The Drupal entity id such as 1.
   * @param \Drupal\entity_inherit\EntityInherit $app
   *   The global app.
   */
  public function __construct(string $type, string $id, EntityInherit $app) {
    $this->id = $id;
    parent::__construct($type, $app);
  }

  /**
   * {@inheritdoc}
   */
  public function applies(EntityInheritSingleFieldValueInterface $field_value) : bool {
    $field_name = $field_value->fieldName();

    return ($this->hasField($field_name) && $this->value($field_name) == $field_value->previousValue() && $field_value->changed());
  }

  /**
   * Get all children of this entity.
   *
   * @return \Drupal\entity_inherit\EntityInheritEntity\EntityInheritExistingMultipleEntitiesInterface
   *   This entity's children.
   */
  public function children() : EntityInheritExistingMultipleEntitiesInterface {
    return $this->app->getStorage()->getChildrenOf($this->getType(), $this->getId());
  }

  /**
   * {@inheritdoc}
   */
  public function fieldValues() : EntityInheritFieldValueCollectionInterface {
    $factory = $this->app->getFieldValueFactory();
    $return = $factory->newCollection();
    $original = $this->original();

    foreach (array_keys($this->inheritableFields()) as $field_name) {
      $return->add($factory->newFieldValue($field_name, $this->value($field_name), $original->value($field_name)));
    }

    return $return;
  }

  /**
   * {@inheritdoc}
   */
  public function getDrupalEntity() : EntityInterface {
    if ($this->drupalEntity === NULL) {
      $this->drupalEntity = $this->app->getEntityTypeManager()->getStorage($this->type)->load($this->id);
    }
    if ($this->drupalEntity === NULL) {
      throw new \Exception('Cannot create entity of type ' . $this->type . ' with id ' . $this->id);
    }
    return $this->drupalEntity;
  }

  /**
   * Get this entity's id.
   *
   * @return string
   *   This entity's id.
   */
  public function getId() : string {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function hasNewParents() : bool {
    return count($this->getMergedParents()->remove($this->original()->getMergedParents())) > 0;
  }

  /**
   * Get the original entity before it was modified on save.
   *
   * @return \Drupal\entity_inherit\EntityInheritEntity\EntityInheritEntityRevisionInterface
   *   The original entity.
   */
  public function original() : EntityInheritEntityRevisionInterface {
    $entity = $this->getDrupalEntity();
    if (isset($entity->original)) {
      return new EntityInheritOriginalEntity($entity->original, $this->app);
    }
    else {
      $this->app->userErrorMessage($this->t('Could not obtain the original entity for @type @id. Using saved entity instead.', [
        '@type' => $this->getType(),
        '@id' => $this->id,
      ]));
      return $this;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function originalValue(string $field_name) : array {
    return $this->original()->value($field_name);
  }

  /**
   * {@inheritdoc}
   */
  public function presave() {
    $this->app->getQueue()->add($this->children()->toQueueable());
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() : array {
    return [
      $this->toStorageId() => $this,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function toQueueable() : EntityInheritQueueableCollectionInterface {
    $return = new EntityInheritStoredQueueableCollection();
    $return->add(new EntityInheritStoredQueueable($this->toStorageId()));
    return $return;
  }

  /**
   * {@inheritdoc}
   */
  public function toStorageId() : string {
    return $this->type . ':' . $this->id;
  }

}