<?php

namespace Drupal\entity_inherit\Utilities;

use Drupal\entity_inherit\EntityInherit;

/**
 * Run tests on a running environment.
 */
class SelfTester {

  /**
   * The injected entity_inherit service.
   *
   * @var \Drupal\entity_inherit\EntityInherit
   */
  protected $wWatchdog;

  /**
   * Class constructor.
   *
   * @param \Drupal\entity_inherit\EntityInherit $wWatchdog
   *   The injected entity_inherit service.
   */
  public function __construct(EntityInherit $wWatchdog) {
    $this->wWatchdog = $wWatchdog;
  }

  /**
   * Print some test result to screen.
   */
  public function print($mixed) {
    if (is_string($mixed)) {
      print_r($mixed . PHP_EOL);
    }
    else {
      print_r($mixed);
    }
  }

  /**
   * Run some self-tests on this module.
   */
  public function selfTest() {
    $this->print('Starting self-test');
    $num_plugins = count($this->wWatchdog->plugins());
    $expecting = 2;
    if ($num_plugins != $expecting) {
      $this->print('Error: we expect to have $expecting plugin, we have ' . $num_plugins);
      exit(1);
    }
    $this->print('Ending self-test');
  }

}
