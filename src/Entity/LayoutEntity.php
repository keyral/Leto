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
 *   links = {
 *     "canonical" = "/admin/structure/layout_entity/{layout_entity}",
 *     "add-form" = "/admin/structure/layout_entity/add",
 *     "edit-form" = "/admin/structure/layout_entity/{layout_entity}/edit",
 *     "delete-form" = "/admin/structure/layout_entity/{layout_entity}/delete",
 *     "collection" = "/admin/structure/layout_entity",
 *   },
 *   field_ui_base_route = "layout_entity.settings"
 * )
 */
class LayoutEntity extends ContentEntityBase implements LayoutEntityInterface {
  use EntityChangedTrait;
  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? NODE_PUBLISHED : NODE_NOT_PUBLISHED);
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

    $fields['content'] = BaseFieldDefinition::create('blob:big')
      ->setLabel(t('Content'))
      ->setDescription(t('Reference and information for content'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ));

    $fields['layout'] = BaseFieldDefinition::create('string')
        ->setLabel(t('Machine Name Layout'))
        ->setDescription(t('The machine name for layout.'))
        ->setComputed(TRUE);

    return $fields;
  }

}
