<?php

/**
 * @file
 * Contains \Drupal\identity_contact\ContactInterface.
 */

namespace Drupal\identity_contact;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a email contact entity.
 */
interface ContactInterface extends ContentEntityInterface {

  /**
   * Gets the owner of the contact.
   *
   * @return \Drupal\user\UserInterface
   *   A user object, or NULL if the user was deleted.
   */
  public function getOwner();

  /**
   * Gets the user ID of the logged-in user.
   *
   * @return int
   *   The user ID.
   *
   * @see \Drupal\Core\Session\AccountInterface::id()
   */
  public static function getCurrentUserId();

}
