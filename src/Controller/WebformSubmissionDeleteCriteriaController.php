<?php

namespace Drupal\webform_submission_delete_criteria\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Dorra Module routes.
 */
class WebformSubmissionDeleteCriteriaController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
