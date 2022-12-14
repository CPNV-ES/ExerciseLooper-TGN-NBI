<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini & Thomas Grossmann
    Date: 12.09.2022
    Description: Route of each actions of controllers
    
*/

use Src\Router\Router;

$router = Router::getInstance($_SERVER['REQUEST_URI']);

/* ------------- Routes ------------- */

$router->get('/', "home#index", "home");

$router->get('/exercises/new', "exercise#new", "newExercise");

$router->post('/exercises/new', "exercise#newPost", "newExercisePost");

$router->post('/exercises/:id/delete', "exercise#delete", "deleteExercise");

$router->get('/exercises/:id/fields', "field#new", "newField");

$router->get('/exercises/:id/fields/:field/edit', "field#edit", "editField");

$router->post('/exercises/:id/fields/:field/edit', "field#editPost", "editFieldPost");

$router->post('/exercises/:id/fields', "field#newPost", "newFieldPost");

$router->get('/exercises/:id/fulfillments/new', "fulfillment#new", "newFulfillment");

$router->post('/exercises/:id/fulfillments/new', "fulfillment#newPost", "newFulfillmentPost");

$router->get('/exercises/:id/fulfillments/:fulfillment/edit', "fulfillment#edit", "editFulfillment");

$router->post('/exercises/:id/fulfillments/:fulfillment/edit', "fulfillment#editPost", "editFulfillmentPost");

$router->post('/exercises/:id/fields/:field/delete', "field#delete", "deleteField");

$router->post('/exercises/:id/:state', "exercise#updateState", "updateState");

$router->get('/exercises/answering', "exercise#answering");

$router->get('/exercises', "exercise#manage", "manage");

$router->get('/exercises/:id/results', "exercise#results", "results");

$router->get('/exercises/:id/results/:field', "fulfillment#result", "fulfillmentResult");

$router->get('/exercises/:id/fulfillments/:fulfillment', "fulfillment#results", "fulfillmentResults");

$router->run();
