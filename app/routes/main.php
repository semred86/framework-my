<?php


use App\core\Router;

Router::add('post/(?<id>\d+)', ['controller' => 'post', 'action' => 'getOne']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?<controller>[a-z-]+)/?(?<action>[a-z-]+)?/?(?<id>\d+)?');

//Router::add('{controller}/{action}/{id}');
