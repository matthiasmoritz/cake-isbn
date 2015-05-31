# Isbn plugin for CakePHP

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
