<?php
namespace TuDublin;

class AdminController
{
    public function editMovieForm($id)
    {
        $movieRepository = new MovieRepository();
        $movie = $movieRepository->getOneById($id);

        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();

        $pageTitle = 'edit movie';
        require_once __DIR__ . '/../templates/admin/editMovieForm.php';
    }


    public function processUpdateMovie()
    {
        $id = filter_input(INPUT_GET, 'id');
        $title = filter_input(INPUT_GET, 'title');
        $price = filter_input(INPUT_GET, 'price');
        $categoryId = filter_input(INPUT_GET, 'categoryId');

        $movie = new Movie();
        $movie->setId($id);
        $movie->setTitle($title);
        $movie->setPrice($price);
        $movie->setCategoryId($categoryId);

        $movieRepository = new MovieRepository();
        $success = $movieRepository->update($movie);


        if($success){
            $mainController = new MainController();
            $mainController->listMovies();
        } else {
            $errors[] = "error trying to UPDATE with id = '$id', title = '$title', price = '$price'";
            require_once __DIR__ . '/../templates/error.php';
        }
    }


    function newMovieForm()
    {
        $pageTitle = 'new movie';
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        require_once __DIR__ . '/../templates/admin/newMovieForm.php';
    }

    function createNewMovie()
    {
        $title = filter_input(INPUT_GET, 'title');
        $price = filter_input(INPUT_GET, 'price');
        $categoryId = filter_input(INPUT_GET, 'categoryId');

        $isValid = true;
        $errors = [];
        if(empty($title)) {
            $isValid = false;
            $errors[] = '- missing or empty title';
        }

        if(empty($price)){
            $isValid = false;
            $errors[] = '- missing or empty price';
        } elseif(empty($price)){
            $isValid = false;
            $errors[] = '- price was not a number';
        }



        if($isValid){
            $this->insertMovie($title, $price, $categoryId);
        } else {
            $pageTitle = 'error';
            require_once __DIR__ . '/../templates/error.php';
        }


    }

    private function insertMovie($title, $price, $categoryId)
    {
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->setPrice($price);
        $movie->setCategoryId($categoryId);

        $movieRepository = new MovieRepository();
        $success = $movieRepository->create($movie);

        if($success){
            // now list all movies
            $mainController = new MainController();
            $mainController->listMovies();
        } else {
            $errors = [];
            $errors[] = "there was an error trying to CREATE movie with title = '$title' and price = '$price'";
            $pageTitle = 'error';
            require_once __DIR__ . '/../templates/error.php';
        }
    }


    public function deleteMovie()
    {
        $id = filter_input(INPUT_GET, 'id');

        $movieRepository = new MovieRepository();
        $success = $movieRepository->delete($id);

        if($success){
            // now list all movies
            $mainController = new MainController();
            $mainController->listMovies();
        } else {
            $errors = [];
            $errors[] = "there was an error trying to DELETE movie with id = '$id''";
            $pageTitle = 'error';
            require_once __DIR__ . '/../templates/error.php';
        }
    }
}

