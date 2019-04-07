<?php
namespace TuDublin;

class ChartController
{
    public function charts()
    {
        $chartRepository = new ChartRepository();
        $charts = $chartRepository->getAll();

        $pageTitle = 'charts';
        $chartPageStyle = "current_page";

        require_once __DIR__ . '/../templates/charts.php';
    }

    public function chartList($id)
    {
        $chartRepository = new ChartRepository();
        $chart = $chartRepository->getOneById($id);

        $chartMovies = $chart->getChartMovies();

        $pageTitle = 'chart list';

        require_once __DIR__ . '/../templates/chartList.php';
    }

    public function chartListFromRepository($id)
    {
        $chartRepository = new ChartRepository();
        $chart = $chartRepository->getOneById($id);

        $chartMovieRepository = new ChartMovieRepository();
        $chartMovies = $chartMovieRepository->getAllForChartId($id);

        $pageTitle = 'chart list';

        require_once __DIR__ . '/../templates/chartList.php';
    }

}

