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
$router->get('/achievements/owned/user/(\d+)', 'AchievementController@getAllOwnedAchievements'); // admin only
$router->get('/achievements/nonowned/user/(\d+)', 'AchievementController@getAllUnownedAchievements'); // admin only

// routes for the users endpoint
$router->post('/users', 'UserController@register');
$router->post('/users/login', 'UserController@login');
$router->get('/users/top', 'UserController@getTopUsers');
$router->delete('/users', 'UserController@delete'); // admin only
$router->get('/users', 'UserController@getAll'); // admin only
$router->get('/users(\d+)', 'UserController@getOne'); // admin only
$router->post('/users', 'UserController@create'); // admin only

// routes for the userachievements endpoint
$router->get('/userachievements', 'UserAchievementController@getAll'); // admin only
$router->get('/userachievements/account/(\d+)', 'UserAchievementController@getAllByUserId'); // user and admin only
$router->post('/userachievements', 'UserAchievementController@create'); // admin only
$router->delete('/userachievements/(\d+)', 'UserAchievementController@delete'); // admin only
$router->delete('/userachievements/unassign', 'UserAchievementController@unassign'); // admin only

// Run it!
$router->run();