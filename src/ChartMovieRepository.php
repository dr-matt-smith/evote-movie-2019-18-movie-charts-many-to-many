<?php
namespace TuDublin;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;
use Mattsmithdev\PdoCrudRepo\DatabaseManager;

class ChartMovieRepository extends DatabaseTableRepository
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__, 'ChartMovie', 'chartmovie');
    }


    public function getAllForChartId($id)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM chartmovie WHERE chartId = :chartId';

        $statement = $connection->prepare($sql);
        $statement->bindParam(':chartId', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->getClassNameForDbRecords());
        $statement->execute();

        $chartMovies = $statement->fetchAll();

        return $chartMovies;
    }
}