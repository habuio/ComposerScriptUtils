ComposerScriptUtils Configuration Handlers
==========================================

The library ships with several configuration handlers to make your script's
configuration definitions easier to read and understand.

Required
--------

This handler will make a specific configuration key required, and an exception
will be thrown if the node is not present in the ``composer.json`` configuration
for your script.

DefaultValue
------------

This handler makes a specific configuration key optional, and when it's requested
within your script with ``$configuration->get('key')``, it will return the defined
default value.