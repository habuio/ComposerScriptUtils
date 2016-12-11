<?php

namespace Habu\Tests\ComposerScriptUtils\Configuration\Concrete;

use Habu\ComposerScriptUtils\Configuration\AbstractConfiguration;

class EmptyConfiguration extends AbstractConfiguration
{
    public function getConfigurationDefaults()
    {
        return [];
    }
}