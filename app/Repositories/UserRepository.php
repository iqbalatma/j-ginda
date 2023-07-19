<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\User;

class UserRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

}