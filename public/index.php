<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Index of the website.
*/

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require(BASE_DIR."/vendor/autoload.php");
require(SOURCE_DIR."/routes.php");