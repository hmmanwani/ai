<?php

/**
 * Example Model
 */

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

/**
 * Example Model Class
 */
class ExampleModel extends Model
{
    /**
     * Table Name - will be prefixed with WP's prefix so no need to prefix
     * 
     * @var string
     */
    protected $table = 'example';
    /** 
     * Disables Eloquent's default created_at and updated_at columns
     * If you enable this, remember to create the columns in the table structure
     * 
     * @var bool
     */
    public $timestamps = false; 

    /**
     * Fillable fileds
     * 
     * @var array
     */
    protected $fillable = array(
        'name',
        'email',
    );
}