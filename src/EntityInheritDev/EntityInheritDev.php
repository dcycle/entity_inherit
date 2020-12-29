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
   * @param mixed $va1
   *   An artibrary value which should equal $val2.
   * @param mixed $va2
   *   An artibrary value which should equal $val1.
   * @param string $message
   *   A message.
   */
  public function assert($val1, $val2, string $message) {
    if ($val1 == $val2) {
      $this->print('Assertion passed: ' . $message);
    }
    else {
      $this->print('Assertion failed, dying: ' . $message);
      $this->print('* * * * * * *');
      $this->print($val1);
      $this->print('* * * * * * *');
      $this->print($val2);
      $this->print('* * * * * * *');
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
    $this->assert($app->parentFieldFeedback()['severity'], 1, 'Severity is 1 because we have no fields.');
    $app->setParentEntityFields(['field_bla.']);
    $this->assert($app->parentFieldFeedback()['severity'], 2, 'Severity is 2 because the parent field does not exist.');
    $app->setParentEntityFields(['field_bla', 'field_parents']);
    $this->assert($app->parentFieldFeedback()['severity'], 2, 'Severity is 2 because one of the parent fields does not exist.');
    $app->setParentEntityFields(['field_parents']);
    $this->assert($app->parentFieldFeedback()['severity'], 0, 'Severity is 0 because the parent field exists.');
    $first = $this->createNode('First Node', 'page');
    $second = $this->createNode('Second Node', 'page', [$first->id()]);
    $this->assert(array_key_exists('body', $app->wrap($second)->inheritableFields()), TRUE, 'The body field is inheritable.');
    $this->assert(1, count($app->wrap($second)->inheritableFields()), 'The body field is the only inheritable field.');
    $this->happyPath();
  }

  /**
   * Test a use case where a new child is created for an existing parent.
   *
   * The body field should be inherited because it's empty in the child.
   */
  public function happyPath() {
    $this->print('New child of existing parent');
    $parent = $this->createNode('Existing parent', 'page', [], [
      'body' => [
        'value' => 'Hello',
        'format' => 'full_html',
      ],
    ]);
    $child = $this->createNode('New child of existing parent, empty body', 'page', [$parent->id()]);
    // See https://github.com/mglaman/phpstan-drupal/issues/159.
    // @phpstan-ignore-next-line
    $this->assert($child->get('body')->getValue(), [
      [
        'value' => 'Hello',
        'summary' => '',
        'format' => 'full_html',
      ],
    ], 'Body is inherited from parent to child.');
    $child2 = $this->createNode('New child of existing parent, empty body', 'page', [$parent->id()], [
      'body' => [
        'value' => 'Hi',
        'format' => 'full_html',
      ],
    ]);
    $this->assert($child2->body->getValue(), [
      [
        'value' => 'Hi',
        'summary' => '',
        'format' => 'full_html',
      ],
    ], 'Body is not inherited from parent to child because child defines its own body.');

    $this->print('Parent changes; child should change as well.');
    // See https://github.com/mglaman/phpstan-drupal/issues/159.
    // @phpstan-ignore-next-line
    $parent->set('body', 'Hi');
    $parent->save();
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
   * @param array $other
   *   Other information to add to the new node.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   A resulting entity.
   */
  public function createNode(string $title, string $type, array $parents = [], array $other = []) {
    $this->print('Creating node ' . $title);
    $node = Node::create([
      'type' => 'page',
      'title' => $title,
      'field_parents' => $this->formatParents($parents),
    ] + $other);
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
