<?php
namespace TuDublin;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;


class ChartMovieRepository extends DatabaseTableRepository
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__, 'ChartMovie', 'chartmovie');
    }
}