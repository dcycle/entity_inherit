<?php

namespace Drupal\entity_inherit\EntityInheritAction;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * An entity action.
 */
class EntityInheritAction implements EntityInheritActionInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function toTranslatedString() : string {
    return $this->t('Generic action');
  }

}
