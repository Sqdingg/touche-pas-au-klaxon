<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
session_start();

use Buki\Router\Router;

$router = new Router([
    'debug' => false,
    'namespaces' => [
        'controllers' => 'App\Controllers',
    ],
    'paths' => [
        'controllers' => __DIR__ . '/../app/Controllers',
    ],
]);

// Pages publiques
$router->get('/', 'App\Controllers\TrajetController@index');
$router->get('/connexion', 'App\Controllers\AuthController@showLogin');
$router->post('/connexion', 'App\Controllers\AuthController@login');
$router->get('/deconnexion', 'App\Controllers\AuthController@logout');

// Trajets (utilisateur connecté)
$router->get('/trajet/creer', 'App\Controllers\TrajetController@create');
$router->post('/trajet/creer', 'App\Controllers\TrajetController@store');
$router->get('/trajet/:id/modifier', 'App\Controllers\TrajetController@edit');
$router->post('/trajet/:id/modifier', 'App\Controllers\TrajetController@update');
$router->post('/trajet/:id/supprimer', 'App\Controllers\TrajetController@destroy');

// Administration
$router->get('/admin', 'App\Controllers\AdminController@dashboard');
$router->get('/admin/utilisateurs', 'App\Controllers\AdminController@listUtilisateurs');
$router->get('/admin/agences', 'App\Controllers\AdminController@listAgences');
$router->post('/admin/agences/creer', 'App\Controllers\AdminController@storeAgence');
$router->post('/admin/agences/:id/modifier', 'App\Controllers\AdminController@updateAgence');
$router->post('/admin/agences/:id/supprimer', 'App\Controllers\AdminController@destroyAgence');
$router->get('/admin/trajets', 'App\Controllers\AdminController@listTrajets');
$router->post('/admin/trajets/:id/supprimer', 'App\Controllers\AdminController@destroyTrajet');

$router->run();