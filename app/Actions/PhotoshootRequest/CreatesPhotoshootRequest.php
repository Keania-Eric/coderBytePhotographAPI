<?php
namespace App\Actions\PhotoshootRequest;

use App\Models\PhotoshootRequest;
use App\Contracts\PhotoshootRequest\ICreatesPhotoshootRequest;


class CreatesPhotoshootRequest implements ICreatesPhotoshootRequest
{


    /**
     * Creates a photoshoot  request
     *
     * @param array $data [Data needed to create request]
     *
     * @return \App\Models\PhotoshootRequest
     */
    public function createRequest(array $data) : PhotoshootRequest
    {
        return PhotoshootRequest::create($data);
    }
}