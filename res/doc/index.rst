Getting started with ComposerScriptUtils
========================================

This library provides a micro-framework for building and configuring your own Composer scripts
that rely on Composer event callbacks.

The purpose of this library is to create a good, unified way to write Composer scripts instead
of

Prerequisites
-------------

This library is stand-alone and depends on nothing else except Composer and at least PHP 5.5.*

Installation
------------

Install library with Composer
_____________________________

First you have to install it using Composer:

.. code-block:: bash

    $ composer require habu/composer-script-utils


Writing your first command
--------------------------

Let's run through creating your first command.

Creating your script configuration
__________________________________


It's recommended to always store your script's configuration inside the 'extra' node within
your composer.json. The configuration management utility supports both root-level configuration
and multi-dimensional/nested configuration.

Root/single-level configuration would look like this in your composer.json:

.. code-block:: json

  ...
  "extra": {
    "habu-script-example": "my configuration value"
  }
  ...

You will need to create your script configuration as a static definition that inherits
upon our abstract configuration class:

.. code-block:: php

    <?php

    // Configuration.php

    namespace Habu\ComposerScriptExample;

    use Habu\ComposerScriptUtils\Configuration\AbstractConfiguration;
    use Habu\ComposerScriptUtils\Configuration\Handler\Required;

    class Configuration extends AbstractConfiguration
    {
        public function getConfigurationDefaults()
        {
            return [
                'habu-script-example' => new Required()
            ];
        }
    }

And here's how you would express nested/multi-dimensional configuration:

.. code-block:: json

  ...
  "extra": {
    "habu-script-example": {
        "name": "Ruben"
    }
  }
  ...

With of our definition looking like this:

.. code-block:: php

    <?php

    // Configuration.php

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

In this example we use the 'Required' handler, but there is more than one handler available
which we will touch upon later.

Creating your processor script
______________________________

Now that we have a configuration definition, let's write ourselves a processor that will
simply write to the screen one of the configuration values we've defined above.

You will need to create a processor class that inherits upon the abstract processor class
that ships with this library:

.. code-block:: php

    <?php

    namespace Habu\ComposerScriptExample;

    use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
    use Habu\ComposerScriptUtils\Processor\AbstractProcessor;

    class Processor extends AbstractProcessor
    {
        public function process(ConfigurationInterface $configuration)
        {
            $this->getIO()->write(sprintf('Hello %s!', $configuration->get('habu-script-example.name')));
        }
    }

Each processor class requires you to implement a 'process' method that accepts a configuration
as a parameter.

This example assumes your script will do one thing, and therefore the processor is just called
'Processor'. In the `Examples <examples.rst>`_ page you will find some examples of how to structure
multi-command processors.


Creating your script entrypoint
_______________________________

Each script requires an executable entrypoint that Composer will pass the event into.


Configuring your script to run
______________________________


Examples
--------

This library ships with a few examples on how to structure your Composer commands with
the help of this library. Consult the `Examples <examples.rst>`_ documentation page to find out
which examples they are and what purpose they serve.