<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Adds the Contao configuration structure.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('contao');

        $rootNode
            ->children()
                ->booleanNode('prepend_locale')
                    ->defaultFalse()
                ->end()
                ->scalarNode('url_suffix')
                    ->defaultValue('.html')
                ->end()
                ->scalarNode('upload_path')
                    ->cannotBeEmpty()
                    ->defaultValue('files')
                    ->validate()
                    ->ifTrue(function ($v) {
                        return preg_match('@^(app|assets|contao|plugins|share|system|templates|vendor|web)(/|$)@', $v);
                    })
                    ->thenInvalid('%s')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
