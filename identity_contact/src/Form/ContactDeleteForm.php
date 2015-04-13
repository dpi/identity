<?php

/**
 * @file
 * Contains \Drupal\identity_contact\Form\ContactDeleteForm.
 */

namespace Drupal\identity_contact\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for deleting a contact.
 */
class ContactDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete this contact?');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return $this->entity->urlInfo();
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $contact = $this->entity;
    $contact->delete();
    drupal_set_message(t('Contact deleted.'));
  }

}
