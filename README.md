# Isbn plugin for CakePHP
This Plugin splits a valid ISBN-13 Number in its components (ean, group, publisher, title, checkdigit)

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require "matthiasmoritz/cake-isbn" "dev-master"
```

## Usage

Load the plugin in your config/bootstrap.php

```php
Plugin::load('Isbn');
```

In your controller
```php
public function initialize(){
    $this->loadComponent('Isbn.Isbn');
}

$this->Isbn->validate($isbn);

$this->Isbn->splitIsbn($isbn);
```
