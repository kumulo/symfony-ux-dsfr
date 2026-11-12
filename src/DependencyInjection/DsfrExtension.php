<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use SymfonyUxDsfr\Service\SearchOptions;

class DsfrExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $this->loadSearchConfig($config, $container);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container): void
    {
        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        $this->enableTwigConfiguration($container, $config);
        $this->enableTwigComponentConfiguration($container);
        $this->enableTranslatorConfiguration($container);
        if ('encore' === $config['dsfr_integration_mode']) {
            $this->enableWebpackConfiguration($container);
        }
    }

    private function loadSearchConfig(array $config, ContainerBuilder $container): void
    {
        $definition = $container->register(SearchOptions::class, SearchOptions::class);
        $definition->setPublic(true);
        if (isset($config['search'])) {
            $definition->setArguments([
                $config['search']['form_action'] ?? null,
                $config['search']['form_method'] ?? null,
                $config['search']['input_name'] ?? null,
            ]);
        }
    }

    private function enableTwigConfiguration(ContainerBuilder $container, array $config): void
    {
        if ($container->hasExtension('twig')) {
            $container->prependExtensionConfig('twig', [
                'paths' => [
                    dirname(__DIR__).'/Resources/templates' => 'UxDsfr',
                ],
                'globals' => [
                    'ux_dsfr_integration_mode' => $config['dsfr_integration_mode'],
                ],
            ]);
            if ($config['form_theme']) {
                $container->prependExtensionConfig('twig', ['form_themes' => ['@UxDsfr/form/form_dsfr_layout.html.twig']]);
            }
        }
    }

    private function enableTwigComponentConfiguration(ContainerBuilder $container): void
    {
        if ($container->hasExtension('twig_component')) {
            $container->prependExtensionConfig('twig_component', [
                'defaults' => [
                    'SymfonyUxDsfr\Twig\Components\\' => [
                        'template_directory' => '@UxDsfr/components/',
                        'name_prefix' => 'UxDsfr',
                    ],
                ],
            ]);
        }
    }

    private function enableWebpackConfiguration(ContainerBuilder $container): void
    {
        if ($container->hasExtension('webpack_encore')) {
            $container->prependExtensionConfig('webpack_encore', [
                'builds' => [
                    'dsfr' => '%kernel.project_dir%/public/bundles/symfonyuxdsfr/',
                ],
            ]);
        }
    }

    private function enableTranslatorConfiguration(ContainerBuilder $container): void
    {
        if ($container->hasExtension('translator')) {
            $container->prependExtensionConfig('framework', [
                'translator' => [
                    'paths' => [
                        dirname(__DIR__).'/Resources/translations',
                    ],
                ],
            ]);
        }
    }
}
