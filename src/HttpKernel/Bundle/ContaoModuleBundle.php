<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\HttpKernel\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Allows to register legacy Contao modules as bundle.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
final class ContaoModuleBundle extends Bundle
{
    /**
     * Sets the module name and application root directory.
     *
     * @param string $name
     * @param string $rootDir
     *
     * @throws \LogicException
     */
    public function __construct($name, $rootDir)
    {
        $this->name = $name;
        $this->path = dirname($rootDir).'/system/modules/'.$this->name;

        if (!is_dir($this->path)) {
            throw new \LogicException(sprintf('The module folder "system/modules/%s" does not exist.', $this->name));
        }
    }
}
