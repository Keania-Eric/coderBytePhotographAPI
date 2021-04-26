<?php
namespace App\Contracts\PhotoshootRequest;

use App\Models\PhotoshootRequest;


interface ICreatesPhotoshootRequest
{
    
    /**
     * Creates a photoshoot  request
     *
     * @param array $data [Data needed to create request]
     *
     * @return \App\Models\PhotoshootRequest
     */
    public function createRequest(array $data) : PhotoshootRequest;

}