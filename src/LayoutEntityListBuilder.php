<?php

/**
 * @file
 * Contains \Drupal\leto\LayoutEntityListBuilder.
 */

namespace Drupal\leto;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Layout entity entities.
 *
 * @ingroup leto
 */
class LayoutEntityListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Layout entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\leto\Entity\LayoutEntity */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.layout_entity.edit_form', array(
          'layout_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
