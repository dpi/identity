<?php

/**
 * @file
 * Contains \Drupal\identity_contact\Plugin\EntityReferenceSelection\IdentityContactRNGSelection.
 */

namespace Drupal\identity_contact\Plugin\EntityReferenceSelection;

use Drupal\rng\Plugin\EntityReferenceSelection\RNGSelectionBase;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Database\Connection;
use Drupal\rng\EventManagerInterface;
use Drupal\Core\Condition\ConditionManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides selection for contact entities when registering.
 *
 * @EntityReferenceSelection(
 *   id = "rng:register:identity_contact",
 *   label = @Translation("Contact selection"),
 *   entity_types = {"identity_contact"},
 *   group = "rng_register",
 *   provider = "rng",
 *   weight = 10
 * )
 */
class IdentityContactRNGSelection extends RNGSelectionBase {

  /**
   * {@inheritdoc}
   */
  protected function buildEntityQuery($match = NULL, $match_operator = 'CONTAINS') {
    $query = parent::buildEntityQuery($match, $match_operator);

    // Select contacts owned by the user.
    if ($this->currentUser->isAuthenticated()) {
      $query->condition('owner', $this->currentUser->id(), '=');
    }
    else {
      // Cancel the query.
      $query->condition($this->entityType->getKey('id'), NULL, 'IS NULL');
      return $query;
    }

    return $query;
  }

}
