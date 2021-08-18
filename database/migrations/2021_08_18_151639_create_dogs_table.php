<?php

use App\Http\Models\Dog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Dog::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Dog::F_NAME);
            $table->unsignedInteger(Dog::F_AGE);
            $table->unsignedDouble(Dog::F_WEIGHT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Dog::TABLE_NAME);
    }
}
