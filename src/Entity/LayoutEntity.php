<?php

/**
 * @file
 * Contains \Drupal\leto\Entity\LayoutEntity.
 */

namespace Drupal\leto\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\leto\LayoutEntityInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Layout entity entity.
 *
 * @ingroup leto
 *
 * @ContentEntityType(
 *   id = "layout_entity",
 *   label = @Translation("Layout entity"),
 *   base_table = "layout_entity",
 *   entity_keys = {
 *     "id" = "lid",
 *     "content" = "content",
 *     "layout" = "layout",
 *   },
 * )
 */
class LayoutEntity extends ContentEntityBase {
  use EntityChangedTrait;
  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
  }

  /**
   * {@inheritdoc}
   */
  public function getContent() {
    return $this->get('content')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setContent($content) {
    $this->set('content', $content);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLid() {
    return $this->get('lid')->value;
  }


  /**
   * {@inheritdoc}
   */
  public function getLayout() {
    return $this->get('layout')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setLayout($layout) {
    $this->set('layout', $layout);
    return $this;
  }



  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['lid'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Layout ID'))
      ->setDescription(t('The ID of the Layout entity entity.'))
      ->setReadOnly(TRUE);

    $fields['content'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Content'))
      ->setDescription(t('Reference and information for content'));

    $fields['layout'] = BaseFieldDefinition::create('string')
        ->setLabel(t('Machine Name Layout'))
        ->setRequired(TRUE)
        ->setSetting('max_length', 255)
        ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }

}
