<?php

/**
 * @file
 * Contains \Drupal\leto\Plugin\Field\FieldType\LetoFieldType.
 */

namespace Drupal\leto\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'leto_field_type' field type.
 *
 * @FieldType(
 *   id = "leto_field_type",
 *   label = @Translation("Leto field type"),
 *   description = @Translation("My Field Type") * )
 */
class LetoFieldType extends FieldItemBase {
    /**
     * {@inheritdoc}
     */
    public static function defaultStorageSettings() {
        return array(
            'blocks_allowed' => '',
        ) + parent::defaultFieldSettings();
    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties['target_id'] = DataDefinition::create('string')
            ->setLabel(t('Unique key for entity id'))
            ->setComputed(true)
            ->setReadOnly(true);
        return $properties;
    }

    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {
        return array(
            'columns' => array(
                'target_id' => array(
                    'description' => 'Primary Key: unique ID for container ID',
                    'type' => 'varchar',
                    'length' => 100,
                    'not null' => TRUE,
                ),
            ),
            'indexes' => array(
                'target_id' => array('target_id'),
            ),
        );
    }

    public static function mainPropertyName() {
        return 'target_id';
    }

    public static function fieldSettingsToConfigData(array $settings) {

        if(isset($settings['blocks_allowed'])) {
            $blocksAllowed = [];
            if(!empty($settings['blocks_allowed'])) {
                foreach($settings['blocks_allowed'] as $blockId => $status) {
                    if($blockId === $status) {
                        $blocksAllowed[] = $blockId;
                    }
                }
            }
            $settings['blocks_allowed'] = $blocksAllowed;
        }

        return $settings;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getConstraints() {
        $constraints = parent::getConstraints();
        return $constraints;
    }

    /**
     * {@inheritdoc}
     */
    public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
        $values['target_id'] = 0;
        return $values['target_id'];
    }


    /**
     * {@inheritdoc}
     */
    public function isEmpty() {
        $value = $this->get('target_id')->getValue();
        return $value === NULL || $value === '';
    }


    /**
     * {@inheritdoc}
     */
    public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
        $typeBlock = \Drupal::entityManager()->getBundleInfo('block_content');

        $typesAvailable = [];
        foreach($typeBlock as $nameBundle => $definition) {
            $typesAvailable[$nameBundle] = $definition['label'];
        }

        $elements = [];
        $elements['blocks_allowed'] = [
            '#type' => 'checkboxes',
            '#title' => $this->t("Qu'elle sont Type de block autorisé"),
            '#options' => $typesAvailable,
            '#default_value' => $this->getSetting('blocks_allowed'),
        ];
        return $elements;
    }

}
