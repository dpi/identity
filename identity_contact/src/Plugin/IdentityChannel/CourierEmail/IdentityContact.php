<?php

/**
 * @file
 * Contains \Drupal\identity_contact\Plugin\IdentityChannel\IdentityContact.
 */

namespace Drupal\identity_contact\Plugin\IdentityChannel\CourierEmail;

use Drupal\courier\MessageInterface;
use Drupal\courier\Plugin\IdentityChannel\IdentityChannelPluginInterface;

/**
 * Supports identity_contact entities.
 *
 * @IdentityChannel(
 *   id = "identity:identity_contact:courier_email",
 *   label = @Translation("identity_contact to courier_mail"),
 *   message_entity_type = "courier_email",
 *   identity_entity_type = "identity_contact",
 *   weight = 10
 * )
 */
class IdentityContact implements IdentityChannelPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function applyIdentity(MessageInterface &$message, $identity) {
    /** @var \Drupal\identity_contact\ContactInterface $identity */
    $message->name->value = $identity->label();
    $message->mail->value = $identity->mail->value;
  }

}
