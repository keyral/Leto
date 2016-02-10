<?php

/**
 * @file
 * Contains \Drupal\leto\LetoContenaireManager.
 */

namespace Drupal\leto;

use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Plugin\Discovery\ContainerDerivativeDiscoveryDecorator;
use Drupal\Core\Plugin\Discovery\YamlDiscovery;

/**
 * Provides the default leto_contenaire manager.
 */
class LetoContenaireManager extends DefaultPluginManager implements LetoContenaireManagerInterface {
  /**
   * Provides default values for all leto_contenaire plugins.
   *
   * @var array
   */
  protected $defaults = array(
    // Add required and optional plugin properties.
    'label' => '',
    'colonnes' => '',
    'library' => '',
    'template' => ''
  );

  /**
   * Constructs a LetoContenaireManager object.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   */
  public function __construct(ModuleHandlerInterface $module_handler, CacheBackendInterface $cache_backend) {
    // Add more services as required.
    $this->moduleHandler = $module_handler;
    $this->setCacheBackend($cache_backend, 'leto_contenaire', array('leto_contenaire'));
  }

  /**
   * {@inheritdoc}
   */
  protected function getDiscovery() {
    if (!isset($this->discovery)) {
      $this->discovery = new YamlDiscovery('contenaire', $this->moduleHandler->getModuleDirectories());
      $this->discovery->addTranslatableProperty('label', 'label_context');
      $this->discovery = new ContainerDerivativeDiscoveryDecorator($this->discovery);
    }
    return $this->discovery;
  }

  /**
   * {@inheritdoc}
   */
  public function processDefinition(&$definition, $plugin_id) {
    parent::processDefinition($definition, $plugin_id);

    if (empty($definition['label'])) {
      throw new PluginException(sprintf('This label is requeried', $plugin_id));
    }
    if (empty($definition['colonnes'])) {
      throw new PluginException(sprintf('This number to colonnes is requeried', $plugin_id));
    }
    if (empty($definition['label'])) {
      throw new PluginException(sprintf('This label is requeried', $plugin_id));
    }
    if (empty($definition['template'])) {
      throw new PluginException(sprintf('This template is requeried', $plugin_id));
    }
  }

}
