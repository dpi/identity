<?php

/**
 * @file
 * Contains \Drupal\identity_contact\Form\ContactForm.
 */

namespace Drupal\identity_contact\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\identity_contact\ContactInterface;

/**
 * Form controller for contacts.
 */
class ContactForm extends ContentEntityForm {

  /**
   * The identity_contact entity.
   *
   * @var \Drupal\identity_contact\ContactInterface
   */
  protected $entity;

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state, ContactInterface $contact = NULL) {
    $contact = $this->entity;

    if (!$contact->isNew()) {
      $form['#title'] = $this->t('Edit contact %label', ['%label' => $contact->label()]);
    }

    return parent::form($form, $form_state, $contact);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $contact = $this->entity;
    $is_new = $contact->isNew();
    $contact->save();

    $t_args = array('%label' => $contact->label());
    if ($is_new) {
      drupal_set_message(t('Contact %label has been created.', $t_args));
    }
    else {
      drupal_set_message(t('Contact %label was updated.', $t_args));
    }

    if (!$contact->isNew() && $contact->access('view')) {
      $form_state->setRedirect('entity.identity_contact.canonical', ['identity_contact' => $contact->id()]);
    }
    else {
      $form_state->setRedirect('<front>');
    }
  }

}
