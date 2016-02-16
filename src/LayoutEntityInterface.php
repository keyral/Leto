<?php

/**
 * @file
 * Contains \Drupal\leto\LayoutEntityInterface.
 */

namespace Drupal\leto;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Layout entity entities.
 *
 * @ingroup leto
 */
interface LayoutEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Layout entity name.
   *
   * @return string
   *   Name of the Layout entity.
   */
  public function getName();

  /**
   * Sets the Layout entity name.
   *
   * @param string $name
   *   The Layout entity name.
   *
   * @return \Drupal\leto\LayoutEntityInterface
   *   The called Layout entity entity.
   */
  public function setName($name);

  /**
   * Gets the Layout entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Layout entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Layout entity creation timestamp.
   *
   * @param int $timestamp
   *   The Layout entity creation timestamp.
   *
   * @return \Drupal\leto\LayoutEntityInterface
   *   The called Layout entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Layout entity published status indicator.
   *
   * Unpublished Layout entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Layout entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Layout entity.
   *
   * @param bool $published
   *   TRUE to set this Layout entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\leto\LayoutEntityInterface
   *   The called Layout entity entity.
   */
  public function setPublished($published);

}
