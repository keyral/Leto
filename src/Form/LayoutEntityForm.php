<?php

/**
 * @file
 * Contains \Drupal\leto\Form\LayoutEntityForm.
 */

namespace Drupal\leto\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Layout entity edit forms.
 *
 * @ingroup leto
 */
class LayoutEntityForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\leto\Entity\LayoutEntity */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Layout entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Layout entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.layout_entity.canonical', ['layout_entity' => $entity->id()]);
  }

}
