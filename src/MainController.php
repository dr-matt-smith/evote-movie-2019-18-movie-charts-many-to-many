<?php
namespace TuDublin;

class MainController
{
    public function home()
    {
        $tpageTitle = 'home';
        $homePageStyle = "current_page";
        require_once __DIR__ . '/../templates/index.php';
    }

    public function about()
    {
        $pageTitle = 'about';
        $aboutPageStyle = "current_page";
        require_once __DIR__ . '/../templates/about.php';
    }


    public function contact()
    {
        $pageTitle = 'contact';
        $contactPageStyle = 'current_page';
        require_once __DIR__ . '/../templates/contact.php';
    }


    public function listMovies()
    {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->getAll();

        $pageTitle = 'list';
        $listPageStyle = 'current_page';
        require_once __DIR__ . '/../templates/list.php';
    }

    public function listCheapMovies()
    {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->getAllCheap();

        $pageTitle = 'list';
        $listCheapPageStyle = 'current_page';
        require_once __DIR__ . '/../templates/listCheap.php';
    }


    public function sitemap()
    {
        $pageTitle = 'sitemap';
        $sitemapPageStyle = 'current_page';
        require_once __DIR__ . '/../templates/sitemap.php';
    }
}

