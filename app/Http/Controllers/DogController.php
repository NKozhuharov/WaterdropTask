<?php

namespace App\Http\Controllers;

use App\Http\Models\Dog;
use App\Jobs\AddDog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DogController extends Controller
{
    /**
     * Asynchronously creates a Dog object
     *
     * @param Request $request
     * @return Dog
     * @throws ValidationException
     */
    public function add(Request $request): Dog
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

    /**
     * List all dogs from the database
     *
     * @return Dog[]|Collection
     */
    public function list()
    {
        return Dog::all();
    }
}
