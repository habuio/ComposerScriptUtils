<?php

namespace Habu\ComposerScriptExample;

use Habu\ComposerScriptUtils\Configuration\AbstractConfiguration;
use Habu\ComposerScriptUtils\Configuration\Handler\Required;

class Configuration extends AbstractConfiguration
{
    public function getConfigurationDefaults()
    {
        return [
            'habu-script-example' => [
                'name' => new Required()
            ]
        ];
    }
}
