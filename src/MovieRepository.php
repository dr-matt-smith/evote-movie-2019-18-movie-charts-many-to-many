<?php

namespace TuDublin;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;
use Mattsmithdev\PdoCrudRepo\DatabaseManager;

class MovieRepository extends DatabaseTableRepository
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__, 'Movie', 'movie');
    }


    public function getAllCheap()
    {
        $maxPrice = 5;
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM movie WHERE price < :maxPrice';

        $statement = $connection->prepare($sql);
        $statement->bindParam(':maxPrice', $maxPrice, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->getClassNameForDbRecords());
        $statement->execute();

        $movies = $statement->fetchAll();

        return $movies;
    }
}