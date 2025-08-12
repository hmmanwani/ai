<?php


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create(
    'form_responses', 
    function (Blueprint $table) {
        $table->id('id'); // 1
        $table->integer('form_id'); // 1
        $table->string('name');
        $table->text('data');
        $table->timestamps();
    }
); 
