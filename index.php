<?php

// controller
// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload file
require_once('vendor/autoload.php');

// instantiate F3 base class
$f3 = Base::instance();

// define a default route
$f3->route('GET /', function() {
    // render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// survey route
$f3->route('GET|POST /survey', function($f3) {

    $f3->set('choices', array('one' => 'This midterm is easy',
        'two' => 'I like midterms',
        'three' => 'Today is Monday'));

    // render a view page
    $view = new Template();
    echo $view->render('views/survey.html');

});

// run fat-free
$f3->run();
