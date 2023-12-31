<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class TransactionRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Transaction();
    }

    public function latestTransaction(array $columns = ["*"])
    {
        return $this->model
            ->select($columns)
            ->orderBy("id", "DESC")
            ->first();
    }

}