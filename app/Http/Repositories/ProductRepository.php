<?php

namespace App\Http\Repositories;

use App\Services\Interfaces\Repository;

class ProductRepository implements Repository {
    public function all($filter){}
    public function create($request){}
    public function read($object){}
    public function update($request, $object){}
    public function delete($object){}
}
