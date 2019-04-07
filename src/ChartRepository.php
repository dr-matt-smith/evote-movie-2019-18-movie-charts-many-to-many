<?php
namespace TuDublin;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;

class ChartRepository extends DatabaseTableRepository
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__, 'Chart', 'chart');
    }

}