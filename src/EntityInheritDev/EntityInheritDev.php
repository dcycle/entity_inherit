<?php

namespace Drupal\entity_inherit\EntityInheritDev;

use Drupal\node\Entity\Node;
use Drupal\entity_inherit\EntityInherit;
use Drupal\entity_inherit\Utilities\FriendTrait;

/**
 * Development tools.
 */
class EntityInheritDev {

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
   * Make an assertion. Die on failure.
   *
   * @param bool $assertion
   *   An assertion.
   * @param string $message
   *   A message.
   */
  public function assert(bool $assertion, string $message) {
    if ($assertion) {
      $this->print('Assertion passed: ' . $message);
    }
    else {
      $this->print('Assertion failed, dying: ' . $message);
      die(1);
    }
  }

  /**
   * Create some starter data.
   */
  public function liveTest() {
    $app = $this->app;

    $this->print('Unsetting parent fields.');
    $app->setParentEntityFields([]);
    $this->assert($app->parentFieldFeedback()['severity'] == 1, 'Severity is 1 because we have no fields.');
    $app->setParentEntityFields(['field_bla.']);
    $this->assert($app->parentFieldFeedback()['severity'] == 2, 'Severity is 2 because the parent field does not exist.');
    $app->setParentEntityFields(['field_bla', 'field_parents']);
    $this->assert($app->parentFieldFeedback()['severity'] == 2, 'Severity is 2 because one of the parent fields does not exist.');
    $app->setParentEntityFields(['field_parents']);
    $this->assert($app->parentFieldFeedback()['severity'] == 0, 'Severity is 0 because the parent field exists.');
    $first = $this->createNode('First Node', 'page');
    $second = $this->createNode('Second Node', 'page', [$first->id()]);
    $this->assert(array_key_exists('body', $app->wrap($second)->inheritableFields()), 'The body field is inheritable.');
    $this->assert(1 === count($app->wrap($second)->inheritableFields()), 'The body field is the only inheritable field.');
  }

  /**
   * Create a starter node if it does not exist.
   *
   * @param string $title
   *   A title.
   * @param string $type
   *   A type.
   * @param array $parents
   *   Parent nodes.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   A resulting entity.
   */
  public function createNode(string $title, string $type, array $parents = []) {
    $this->print('Creating node ' . $title);
    $node = Node::create([
      'type' => 'page',
      'title' => $title,
      'field_parents' => $this->formatParents($parents),
    ]);
    $node->save();
    return $node;
  }

  /**
   * Format parents to add to a node.
   *
   * @param array $nodes
   *   Nodes in the format [1, 2].
   *
   * @return array
   *   Nodes in the format [
   *     [
   *       'target_id' => 1,
   *     ],
   *     [
   *       'target_id' => 2,
   *     ],
   *   ].
   */
  public function formatParents(array $nodes) : array {
    $return = [];
    array_walk($nodes, function ($item, $key) use (&$return) {
      $return[] = [
        'target_id' => $item,
      ];
    });
    return $return;
  }

  /**
   * Print an arbitrary variable.
   *
   * @param mixed $var
   *   Anything printable.
   */
  public function print($var) {
    if (is_string($var)) {
      print($var . PHP_EOL);
    }
    else {
      print_r($var);
    }
  }

}
