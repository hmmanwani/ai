<?php

/**
 * Form Response Model
 * 
 * Used with the Form Builder to store form responses.
 */

namespace App\FormBuilder;

use \Illuminate\Database\Eloquent\Model;

/**
 * Form Response Model
 */
class Response extends Model
{
    /**
     * Table Name - will be prefixed with WP's prefix so no need to prefix
     * 
     * @var string
     */
    protected $table = 'form_responses';
    /** 
     * Disables Eloquent's default created_at and updated_at columns
     * If you enable this, remember to create the columns in the table structure
     * 
     * ```mysql
     * created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
     * updated_at DATETIME NULL,
     * ```
     * 
     * @var bool
     */
    public $timestamps = true; 

    /**
     * Fillable fields
     * 
     * @var array
     */
    protected $fillable = array(
        'name',
        'data',
        'form_id',
    );

    protected $casts = [
        'data' => 'array',
    ];
}