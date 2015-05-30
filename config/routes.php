<?php
use Cake\Routing\Router;

Router::plugin('Isbn', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
