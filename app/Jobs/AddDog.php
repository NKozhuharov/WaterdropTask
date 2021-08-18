<?php

namespace App\Jobs;

use App\Http\Models\Dog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class AddDog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected Dog $dog;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dog $dog)
    {
        $this->dog = $dog;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //simulate a long running query
        sleep(2);
        $this->dog->save();
    }
}
