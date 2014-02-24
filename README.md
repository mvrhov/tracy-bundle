Tracy PHP debugger bundle for Symfony
=====================================

This bundle adds the powerful [Tracy debug tool](https://github.com/nette/tracy) to the Symfony2 framework.

[![Nette Tracy screenshot](http://nette.github.io/tracy/images/tracy-exception.png)](http://nette.github.io/tracy/tracy-exception.html)

**Why is Tracy better than the Symfony build-in debugger?**

* Exception stack trace contains values of all method arguments.
* Request & Response & Server environment information is displayed on the error page.
* The whole error page with full stack trace can be easily stored to some directory as HTML file (useful on production mode).
* Webmaster can be notified by email about errors that occured on the site.

See [full Tracy docs](https://github.com/nette/tracy) and [sample error page](http://nette.github.io/tracy/tracy-exception.html).

Tracy is a part of the [Nette Framework](http://nette.org/).

Installation
------------

1) Add __kutny/tracy-bundle__ to your composer.json.

~~~~~ json
"require": {
    "kutny/tracy-bundle": "dev-master"
}
~~~~~

2) Add KutnyTracyBundle to your application kernel

~~~~~ php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new Kutny\TracyBundle\KutnyTracyBundle(),
        // ...
    );
}
~~~~~

Configuration
-------------

Open web/app.php and add the following code **before** the _AppKernel_ class is instantiated:

~~~~~ php
\Tracy\Debugger::enable();
~~~~~

I also recommend you to enable Tracy in a strict mode so it can handle errors of type E_NOTICE and E_WARNING too.

~~~~~ php
\Tracy\Debugger::$strictMode = true;
~~~~~

**Production mode**:

General [Server error page](http://nette.github.io/tracy/images/tracy-error2.png) will be displayed if you enable the Debugger in the production mode. All errors/exceptions will be stored in _app/logs_ directory and sent to errors@mycompany.com.

~~~~~ php
\Tracy\Debugger::enable(Debugger::PRODUCTION, false, 'errors@mycompany.com');
~~~~~

By default the exceptions will be stored in the `%kernel.logs_dir%/exceptions` directory.
You can overwrite the default log directory in your config.yml file

~~~~~ yaml
kutny_tracy:
    exceptions_directory: <directory>
~~~~~

-------------

License
=======

This bundle license: https://github.com/kutny/tracy-bundle/blob/master/LICENSE

Tracy debugger license: https://github.com/nette/tracy/blob/master/license.md