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
$router->post('/achievements', 'AchievementController@create'); // admin only
$router->put('/achievements/(\d+)', 'AchievementController@update'); // admin only
$router->delete('/achievements/(\d+)', 'AchievementController@delete'); // admin only

// routes for the users endpoint
$router->post('/users', 'UserController@register');
$router->post('/users/login', 'UserController@login');
$router->get('/users/top', 'UserController@getTopUsers');
$router->delete('/users', 'AdminController@delete'); // admin only
$router->get('/users', 'AdminController@getAll'); // admin only
$router->get('/users(\d+)', 'AdminController@getOne'); // admin only
$router->post('/users', 'AdminController@create'); // admin only

// routes for the userachievements endpoint
$router->get('/userachievements', 'UserAchievementController@getAll'); // admin only
$router->get('/userachievements/account/(\d+)', 'UserAchievementController@getAllByUserId'); // user and admin only
$router->post('/userachievements', 'UserAchievementController@create'); // admin only
$router->delete('/userachievements/(\d+)', 'UserAchievementController@delete'); // admin only

// Run it!
$router->run();