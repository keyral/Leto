<?php

/**
 * @file
 * Contains \Drupal\leto\Entity\LayoutEntity.
 */

namespace Drupal\leto\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Layout entity entities.
 */
class LayoutEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['layout_entity']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Layout entity'),
      'help' => $this->t('The Layout entity ID.'),
    );

    return $data;
  }

}
