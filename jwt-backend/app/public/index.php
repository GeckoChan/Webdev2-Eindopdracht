<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// routes for the achievement endpoint
$router->get('/achievements', 'AchievementController@getAll');
$router->get('/achievements/(\d+)', 'AchievementController@getOne');
$router->post('/achievements', 'AchievementController@create');
// $router->put('/achievements/(\d+)', 'AchievementController@update');
$router->delete('/achievements/(\d+)', 'AchievementController@delete');

// routes for the users endpoint
$router->post('/users', 'UserController@register');
$router->post('/users/login', 'UserController@login');

// routes for admin endpoint // todo admin
$router->delete('/admin/users', 'AdminController@delete'); 
$router->get('/admin/users', 'AdminController@getAll');
$router->post('/admin/users', 'AdminController@create');

// routes for the userachievements endpoint
$router->get('/userachievements', 'UserAchievementController@getAll');

// Run it!
$router->run();