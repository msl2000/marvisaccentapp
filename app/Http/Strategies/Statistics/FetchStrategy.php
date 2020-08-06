<?php

namespace App\Http\Strategies\Statistics;

interface FetchStrategy
{

    /***
     * This class is built with the Strategy Pattern in mind.
     * The FetchStrategy class provides a way for controllers, repositories and other services to access the resource but
     * return different consumed values.
     * 

     /**
     * Get all objects functionality 
     *
     * @param  null
     * @return Array
     */
    public function fetch();
}
