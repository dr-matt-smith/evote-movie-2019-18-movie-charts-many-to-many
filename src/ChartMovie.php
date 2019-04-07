<?php
namespace TuDublin;


class ChartMovie
{
    private $id;
    private $movieId;
    private $chartId;

    /**
     * return Chart object value of `chartId` in this object
     */
    public function getChart()
    {
        $chartRepository = new ChartRepository();
        $chart = $chartRepository->getOneById($this->chartId);

        return $chart;
    }

    /**
     * return Movie object value of `movieId` in this object
     */
    public function getMovie()
    {
        $movieRepository = new MovieRepository();
        $movie = $movieRepository->getOneById($this->movieId);

        return $movie;
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
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * @param mixed $movieId
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;
    }

    /**
     * @return mixed
     */
    public function getChartId()
    {
        return $this->chartId;
    }

    /**
     * @param mixed $chartId
     */
    public function setChartId($chartId)
    {
        $this->chartId = $chartId;
    }
    
    

}