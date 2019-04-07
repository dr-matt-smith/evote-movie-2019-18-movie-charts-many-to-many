<?php

namespace TuDublin;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;

class CategoryRepository extends DatabaseTableRepository
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__, 'Category', 'category');
    }


}