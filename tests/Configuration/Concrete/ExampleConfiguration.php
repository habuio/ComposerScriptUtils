<?php

namespace Habu\Tests\ComposerScriptUtils\Configuration\Concrete;

use Habu\ComposerScriptUtils\Configuration\AbstractConfiguration;
use Habu\ComposerScriptUtils\Configuration\Handler\DefaultValue;
use Habu\ComposerScriptUtils\Configuration\Handler\Required;

class ExampleConfiguration extends AbstractConfiguration
{
    public function getConfigurationDefaults()
    {
        return [
            'example' => [
                'required-key' => new Required(),
                'default-value-key' => new DefaultValue('default.value')
            ]
        ];
    }
}