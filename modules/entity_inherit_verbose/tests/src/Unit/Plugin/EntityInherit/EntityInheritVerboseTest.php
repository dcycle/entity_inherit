<?php

namespace Drupal\Tests\entity_inherit_verbose\Unit\Plugin\EntityInherit;

use Drupal\Tests\entity_inherit\Unit\EntityInheritTestBase;

/**
 * Test EntityInheritVerbose.
 *
 * @group entity_inherit
 */
class EntityInheritVerboseTest extends EntityInheritTestBase {

  /**
   * Smoke test.
   */
  public function testSmoke() {
    $object = $this->getMockBuilder(EntityInheritVerbose::class)
      // NULL = no methods are mocked; otherwise list the methods here.
      ->setMethods(NULL)
      ->disableOriginalConstructor()
      ->getMock();

    $this->assertTrue(is_object($object));
  }

}
