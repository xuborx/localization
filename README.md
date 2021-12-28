#### Description of the package
This package is designed to localize texts in your application. The package can be installed using composer. Just run a command:

`composer require xuborx/localization`

------------

#### Usage
**IMPORTANT!!!** You must make sure that a composer autoload.php file is included in your project, otherwise this package will not work. It might look like:

```php
require_once 'vendor/autoload.php';
```

First you need to define 1 constant in your project - XU_TRANSLATIONS_FILES_DIR. This constant must contain full path to the directory with translations files.
For example:

```php
define('XU_TRANSLATIONS_FILES_DIR', __DIR__ . '/translations');
```

Make sure this constant is defined before you start using the methods of this package.

Then you can create translation files in your translations directory. File name must consist of a language code and must have the extension .xulocal. For example: **en.xulocal**. Place translations in this file in the form key=value. For example:

    WelcomeMessage=Welcome to the Xuborx Framework 2.0!
    Documentation=See our documentation here

Hooray! Now you can receive the required translations by key for the language you need. You should just use the methods of the TranslationsStorage class.
For getting translation by key just use:
```php
TranslationsStorage::get('Documentation', 'en');
```
First parameter of this method it is a key, second one it is a language.

If you want to get all translations for language in an array form just use:
```php
TranslationsStorage::getAll('en');
```
