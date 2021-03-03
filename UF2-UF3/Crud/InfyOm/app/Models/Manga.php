<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Manga
 * @package App\Models
 * @version February 25, 2021, 2:06 pm UTC
 *
 * @property string $nom
 * @property string $editorial
 */
class Manga extends Model
{
    /* use SoftDeletes; */

    use HasFactory;

    public $table = 'mangas';
    public $timestamps = false;
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'editorial'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'editorial' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required|string|max:200',
        'editorial' => 'required|string|max:200'
    ];

    
}
