<?php

namespace Drupal\pece_about\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Extension\ExtensionPathResolver;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the AboutPece block.
 *
 * @Block(
 *   id = "pece_about_about_pece",
 *   admin_label = @Translation("About PECE")
 * )
 */
class AboutPece extends BlockBase implements ContainerFactoryPluginInterface {

   /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('extension.path.resolver')
    );
  }

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Extension\ExtensionPathResolver $path_resolver
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ExtensionPathResolver $path_resolver) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->pathResolver = $path_resolver;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $twigFilePath = \Drupal::service('extension.path.resolver')
      ->getPath('module', 'pece_about') . '/templates/pece-about-block.html.twig';
    $twigService = \Drupal::service('twig');
    $template = $twigService->loadTemplate($twigFilePath);
    return $template->render();
  }

}
