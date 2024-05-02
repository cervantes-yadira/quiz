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

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $checked = $_POST['options'];

        if(isset($checked)) {
            $checked = implode(", ", $checked);
        }

        $f3->set("SESSION.name", $name);
        $f3->set("SESSION.checked", $checked);

        $f3->reroute('summary');
    }


    $f3->set('choices', array('one' => 'This midterm is easy',
        'two' => 'I like midterms',
        'three' => 'Today is Monday'));

    // render a view page
    $view = new Template();
    echo $view->render('views/survey.html');

});

$f3->route('GET /summary', function() {
    // render a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// run fat-free
$f3->run();
