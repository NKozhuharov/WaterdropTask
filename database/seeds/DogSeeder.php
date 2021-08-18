<?php

use App\Http\Models\Dog;
use Nevestul4o\NetworkController\Database\BaseSeeder;

class DogSeeder extends BaseSeeder
{
    protected $lowCount = 5;
    protected $highCount = 10;

    public function __construct()
    {
        //use Faker to get a fake name for a fake dog :)
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\en_Us\Person($faker));

        for ($i = 0; $i < $this->getCount(); $i++) {
            $this->objects[] = [
                Dog::F_NAME   => $faker->name,
                Dog::F_WEIGHT => rand(100, 1000) / 100,
                Dog::F_AGE    => rand(1, 10),
            ];
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->objects as $object) {
            $this->insertedObjects[] = Dog::create($object);
        }
    }
}
