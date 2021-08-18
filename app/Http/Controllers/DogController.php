<?php

namespace App\Http\Controllers;

use App\Http\Models\Dog;
use App\Jobs\AddDog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function add(Request $request)
    {
        $this->validate(
            $request,
            [
                Dog::F_NAME => 'required|string|min:3|max:255',
                Dog::F_AGE => 'required|integer|min:1|max:100',
                Dog::F_WEIGHT => 'required|numeric|min:0.1|max:100',
            ]
        );

        $dog = new Dog();
        $dog->{Dog::F_NAME} = $request->{Dog::F_NAME};
        $dog->{Dog::F_AGE} = $request->{Dog::F_AGE};
        $dog->{Dog::F_WEIGHT} = $request->{Dog::F_WEIGHT};

        $addDogJob = new AddDog($dog);

        dispatch($addDogJob)->onQueue('dogs');

        return $dog;
    }

    public function list()
    {
        $databaseDogs = Dog::all();

        return $databaseDogs;
    }
}
