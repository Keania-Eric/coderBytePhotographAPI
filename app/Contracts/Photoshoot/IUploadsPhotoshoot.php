<?php
namespace App\Contracts\Photoshoot;

use Illuminate\Http\Request;


interface IUploadsPhotoshoot
{
    
    /**
     * Takes in a request and uploads the shoots
     *
     * @param \Illuminate\Http\Request $request [request sent by the user]
     *
     * @return array
     */
    public function uploadShoots(Request $request):array;
}