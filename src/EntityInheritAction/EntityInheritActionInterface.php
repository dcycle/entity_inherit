<?php

namespace Drupal\entity_inherit\EntityInheritAction;

/**
 * An entity action.
 */
interface EntityInheritActionInterface {

  /**
   * Get a translated string representing this action.
   *
   * @return string
   *   A translated string.
   */
  public function toTranslatedString() : string;

}
