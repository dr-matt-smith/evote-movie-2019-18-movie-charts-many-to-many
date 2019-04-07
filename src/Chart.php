<?php
namespace TuDublin;


class Chart
{
    private $id;
    private $name;

    /**
     * get array of ChartMovie objects for current Chart's ID
     */
    public function getChartMovies()
    {
        $chartMovieRepository = new ChartMovieRepository();
        $chartMovies = $chartMovieRepository->getAll();

        $chartMoviesForThisChart = [];
        foreach ($chartMovies as $chartMovie){
            if($this->id == $chartMovie->getChartId()){
                $chartMoviesForThisChart[] = $chartMovie;
            }
        }

        return $chartMoviesForThisChart;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}