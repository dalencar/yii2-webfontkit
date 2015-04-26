yii2-webfontkit
===============

This extension offers an easy method to setup various webfont frameworks to work with Yii Framework 2.0. 

1. [Open Sans](http://www.google.com/fonts/specimen/Open+Sans)
1. [Roboto](http://www.google.com/fonts/specimen/Roboto)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

> Note: Check the [composer.json](https://github.com/kartik-v/yii2-icons/blob/master/composer.json) for this extension's requirements and dependencies. 

Either run

```
$ php composer.phar require dalencar/yii2-webfontkit "dev-master"
```

or add

```
"dalencar/yii2-webfontkit": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Global Setup

In case you wish to setup one or more Webfont framework globally, set the parameter `webfontkit-framework` in the `params` array of your Yii Configuration File.

```php
'params' => [
  'webfontkit-framework' => [
    'os',  // Open Sans Webfont framework
  ],
]
```
To initialize the globally setup framework, you can proceed in one of two ways:

1. In your view, call this code in your view or view layout file:

```php
use dalencar\webfontkit\WebFontKit;
WebFontKit::register($this);
```

2. Or in your asset bundle, adding the dalencar\webfontkit\WebFontKit class as depends

```php
public $depends [
  'dalencar\webfontkit\WebFontKit',
],
```

### Per View Setup

You can also call each icon-framework individually in your view or view layout like below. Map any icon framework within each view as in the example below.

```php
use dalencar\webfontkit\WebFontKit;
WebFontKit::register($this, WebFontKit::OS); // Register the Open Sans webfont framework
```

## License

**yii2-webfontkit** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.