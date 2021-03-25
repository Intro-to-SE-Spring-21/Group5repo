<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('categories')->insert(
            array(
                'name' => 'Java',
            )
        );
        DB::table('categories')->insert(
            array(
                'name' => 'C++',
            )
        );
        DB::table('categories')->insert(
            array(
                'name' => 'PHP',
            )
        );
        DB::table('categories')->insert(
            array(
                'name' => 'C#',
            )
        );
        DB::table('categories')->insert(
            array(
                'name' => 'Laravel',
            )
        );
        DB::table('categories')->insert(
            array(
                'name' => 'JQuery',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
