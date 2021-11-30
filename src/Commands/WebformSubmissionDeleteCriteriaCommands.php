<?php

namespace Drupal\webform_submission_delete_criteria\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class WebformSubmissionDeleteCriteriaCommands extends DrushCommands {

  /**
   * Deletes submissions based on criteria.
   *
   * @param $source
   * @param array $options
   *   An associative array of options whose values come from cli, aliases,
   *   config, etc.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   * @option option-name
   *   Description
   * @usage webform_submission_delete_criteria-commandName foo
   *   Usage description
   *
   * @command webform_submission_delete_criteria:getSubmission
   * @aliases foo
   */
  public function getSubmission($source, $options = ['option-name' => 'default']) {
//    $storage = \Drupal::entityTypeManager()->getStorage('webform_submission');
//    $webform_submissions = $storage->loadByProperties([
//            'entity_type' => 'node',
//            'entity_id' => $source,
//      //      'created' => 1634113752
////      'sid' => 227394,
//    ]);

    $query = \Drupal::entityQuery('webform_submission')
      ->condition('entity_type', 'node')
      ->condition('entity_id', $source)
        ->condition('created',  1588809600, '>')
      ->accessCheck(FALSE);



    $result = $query->execute();
    foreach ($result as $item) {
      $submission = \Drupal\webform\Entity\WebformSubmission::load($item);
      $submission->delete();
    }



    //    //Delete the Submission
//    foreach ($webform_submissions as $webform_submission )
//    {
//          $webform_submission->delete();
//    }
    $this->logger()->success(dt('success'));
  }

  /**
   * An example of the table output format.
   *
   * @param array $options An associative array of options whose values come
   *   from cli, aliases, config, etc.
   *
   * @field-labels
   *   group: Group
   *   token: Token
   *   name: Name
   * @default-fields group,token,name
   *
   * @command webform_submission_delete_criteria:token
   * @aliases token
   *
   * @filter-default-field name
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   */
  public function token($options = ['format' => 'table']) {
    $all = \Drupal::token()->getInfo();
    foreach ($all['tokens'] as $group => $tokens) {
      foreach ($tokens as $key => $token) {
        $rows[] = [
          'group' => $group,
          'token' => $key,
          'name' => $token['name'],
        ];
      }
    }
    return new RowsOfFields($rows);
  }
}
