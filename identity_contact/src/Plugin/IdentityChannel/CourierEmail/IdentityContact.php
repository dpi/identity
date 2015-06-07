<?php

/**
 * @file
 * Contains \Drupal\identity_contact\Plugin\IdentityChannel\IdentityContact.
 */

namespace Drupal\identity_contact\Plugin\IdentityChannel\CourierEmail;

use Drupal\courier\Plugin\IdentityChannel\IdentityChannelPluginInterface;
use Drupal\courier\ChannelInterface;
use Drupal\Core\Entity\EntityInterface;

/**
 * Supports identity_contact entities.
 *
 * @IdentityChannel(
 *   id = "identity:identity_contact:courier_email",
 *   label = @Translation("identity_contact to courier_mail"),
 *   channel = "courier_email",
 *   identity = "identity_contact",
 *   weight = 10
 * )
 */
class IdentityContact implements IdentityChannelPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function applyIdentity(ChannelInterface &$message, EntityInterface $identity) {
    /** @var \Drupal\identity_contact\ContactInterface $identity */
    /** @var \Drupal\courier\EmailInterface $message */
    $message->setRecipientName($identity->label());
    $message->setEmailAddress($identity->mail->value);
  }

}
