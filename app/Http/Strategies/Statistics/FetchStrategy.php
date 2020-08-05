<?php

namespace App\Http\Strategies\Statistics;

interface FetchStrategy
{
     /**
     * Get all objects functionality 
     *
     * @param  null
     * @return Array
     */
    public function fetch();
}
