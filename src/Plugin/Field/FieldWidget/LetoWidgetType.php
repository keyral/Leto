<?php

/**
 * @file
 * Contains \Drupal\leto\Plugin\Field\FieldWidget\LetoWidgetType.
 */

namespace Drupal\leto\Plugin\Field\FieldWidget;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'leto_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "leto_widget_type",
 *   label = @Translation("Leto widget type"),
 *   field_types = {
 *     "leto_field_type"
 *   }
 * )
 */
class LetoWidgetType extends WidgetBase
{

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state)
    {
        $elements = [];


        $elements['size'] = array(
            '#type' => 'number',
            '#title' => t('Size of textfield'),
            '#default_value' => $this->getSetting('size'),
            '#required' => TRUE,
            '#min' => 1,
        );
        $elements['placeholder'] = array(
            '#type' => 'textfield',
            '#title' => t('Placeholder'),
            '#default_value' => $this->getSetting('placeholder'),
            '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
        );

        return $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary()
    {
        $summary = [];

        $summary[] = t('Textfield size: !size', array('!size' => $this->getSetting('size')));
        if (!empty($this->getSetting('placeholder'))) {
            $summary[] = t('Placeholder: @placeholder', array('@placeholder' => $this->getSetting('placeholder')));
        }

        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function formElement(FieldItemListInterface $items, $delta, array $elements, array &$form, FormStateInterface $form_state)
    {
        $elements = [];
        $item = $items[$delta];


        $elements['layout'] = [
            '#type' => 'select',
            '#options' => ['' => t('Select Layout')] + $this->getLayoutListSelect(),
            '#default_value' => '',//$item->get('layout') ? $item->get('layout')->getValue() : '',
            '#ajax' => [
                'callback' => 'Drupal\leto\Plugin\Field\FieldWidget\LetoWidgetType::getSelctedLayout',
                'event' => 'change',
                'progress' => ['type' => 'fullscreen'],
            ],
            '#attributes' => [
                'class' => ['layout-select'],
            ]
        ];


        $elements['add_items'] = [
            '#type' => 'link',
            '#title' =>  $this->t('Add element to layout'),
            '#url' => Url::fromRoute('config.sync'),
            //'#url' => Url::fromRoute('ikea.liste_blocs_select', [], ['query' => ['blockFilter' => json_encode($blockFilter), 'fieldName' => $fieldName, 'delta' => $delta]]),
            '#wrapper_attributes' => [
                'colspan' => 5,
            ],
            '#attributes' => [
                'class' => ['use-ajax', 'button', 'button--small', 'leto-add_more'],
                'data-dialog-type' => 'modal',
                'data-dialog-options' => Json::encode([
                    'width' => 800,
                    'draggable' => true,
                ]),
            ],
        ];



        $elements['preview'] = array(
            '#type' => 'textfield',
            '#title' => 'preview',

        );
        $elements['#theme'] = 'leto_render_admin';
        $elements['#attached']['library'][] = 'leto/leto.admin';
        return $elements;
    }


    public function getSelctedLayout(array $form, FormStateInterface $form_state)
    {

    }

    public function getLayoutListSelect()
    {
        return ['toto' => 'toto', 'tata' => 'tata'];
    }


}
