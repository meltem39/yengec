<?php

namespace App\Repositories\MarketRepositories;

interface MarketRepositoryInterface{

    public function integrationList();

    public function integrationCreate($data);

    public function integrationUpdate($data);

    public function integrationDelete($id);
}
