ComposerScriptUtils Example Implementations
===========================================

This page outlines several example implementations ranging from single commands
to multiple commands and demonstrating how you could structure your projects that
utilize this library.

Each of the commands are interactive - you can install and run them within their
respective directories:

.. code-block:: bash

    $ composer install

Single command
--------------

This example demonstrates how to structure an implementation that only has a single executable command.

You can find it here: `res/examples/single-command <../examples/single-command>`_

Multiple commands
-----------------

This example demonstrates how to structure an implementation that has multiple commands contained within
multiple `Processor` class, as well as how to apply optional configuration definitions that yield a default
value when missing from the actual configuration.

You can find it here: `res/examples/multi-command <../examples/multi-command>`_