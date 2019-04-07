<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use TuDublin\MainController;
use TuDublin\AdminController;
use TuDublin\LoginController;
use TuDublin\ChartController;

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if(empty($action)){
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
}

// based on value (if any) of 'action' decide which template to output
$mainController = new MainController();
$adminController = new AdminController();
$loginController = new LoginController();
$chartController = new ChartController();
switch ($action){
    // ------ chart movies section --------
    case 'charts':
        $chartController->charts();
        break;

    case 'chartList':
        $id = filter_input(INPUT_GET, 'id');
        $chartController->chartList($id);
//        $chartController->chartListFromRepository($id);
        break;

    // ------ login section --------
    case 'login':
        $loginController->loginForm();
        break;

    case 'logout':
        $loginController->logout();
        break;

    case 'processLogin':
        $loginController->processLogin();
        break;


    // ----- public pages ----
    case 'about':
        $mainController->about();

        break;
    case 'contact':
        $mainController->contact();
        break;

    case 'list':
        $mainController->listMovies();
        break;

    case 'listCheap':
        $mainController->listCheapMovies();
        break;

    case 'sitemap':
        $mainController->sitemap();
        break;

    // ------ admin section --------
    case 'newMovieForm':
        $adminController->newMovieForm();
        break;

    case 'createNewMovie':
        if(isset($_SESSION['username'])){
            $adminController->createNewMovie();
        } else {
            $errors = [
                'you attempted an unauthroised acitonn'
            ];
            require_once __DIR__ . '/../templates/error.php';
        }
        break;

    case 'deleteMovie':
        if(isset($_SESSION['username'])){
            $adminController->deleteMovie();
        } else {
            $errors = [
                'you attempted an unauthroised acitonn'
            ];
            require_once __DIR__ . '/../templates/error.php';
        }
        break;

    case 'editMovie':
        $id = filter_input(INPUT_GET, 'id');
        $adminController->editMovieForm($id);
        break;

    case 'processUpdateMovie':
        $adminController->processUpdateMovie();
        break;

    case 'index':
    default:
        // default is home page ('index' action)
        $mainController->home();
}