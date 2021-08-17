<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DogController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, []);
        exit('add');
    }

    public function list(Request $request)
    {
        exit('list');
    }
}
