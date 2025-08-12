<?php

/**
 * Remove this return in non-example files!
 */
return;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create(
    'example_table_name', 
    function (Blueprint $table) {
        $table->id('id'); // 1
        $table->timestamps();

        $table->string('exampleString');
        $table->integer('exampleInteger');
    }
); 
