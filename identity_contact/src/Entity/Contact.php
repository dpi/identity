<?php

/**
 * @file
 * Contains \Drupal\identity_contact\Entity\Contact.
 */

namespace Drupal\identity_contact\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\identity_contact\ContactInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the contact entity.
 *
 * @ContentEntityType(
 *   id = "identity_contact",
 *   label = @Translation("Contact"),
 *   handlers = {
 *     "access" = "Drupal\identity_contact\AccessControl\ContactAccessControl",
 *     "form" = {
 *       "default" = "Drupal\identity_contact\Form\ContactForm",
 *       "add" = "Drupal\identity_contact\Form\ContactForm",
 *       "edit" = "Drupal\identity_contact\Form\ContactForm",
 *       "delete" = "Drupal\identity_contact\Form\ContactDeleteForm",
 *     },
 *   },
 *   base_table = "identity_contact",
 *   data_table = "identity_contact_field_data",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   links = {
 *     "canonical" = "/identity/contact/{identity_contact}/edit",
 *     "add-form" = "/identity/contact/add",
 *     "edit-form" = "/identity/contact/{identity_contact}/edit",
 *     "delete-form" = "/identity/contact/{identity_contact}/delete"
 *   }
 * )
 */
class Contact extends ContentEntityBase implements ContactInterface {

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('owner')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Contact ID'))
      ->setDescription(t('The contact ID.'))
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setDescription(t('Label used when referencing this contact. Also used displayed in communications sent to the contact.'))
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => 0,
      ));

    $fields['mail'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setDescription(t('The email address for this contact.'))
      ->setDefaultValue('')
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'email_default',
        'weight' => 50,
      ]);

    $fields['owner'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Owner'))
      ->setDescription(t('The owner of this contact.'))
      ->setRequired(TRUE)
      ->setSetting('target_type', 'user')
      ->setDefaultValueCallback('Drupal\identity_contact\Entity\Contact::getCurrentUserId');

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created on'))
      ->setDescription(t('The time that the contact was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The last time the contact was edited.'));

    return $fields;
  }

  /**
   * Default value callback for 'owner' base field definition.
   *
   * @see ::baseFieldDefinitions()
   *
   * @return array
   *   An array of default values.
   */
  public static function getCurrentUserId() {
    return array(\Drupal::currentUser()->id());
  }

}
