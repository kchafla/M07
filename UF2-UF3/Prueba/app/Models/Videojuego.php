<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Videojuego
 * @package App\Models
 * @version February 8, 2021, 4:54 pm UTC
 *
 * @property string $nom
 * @property string $dissenyador
 * @property string $plataforma
 */
class Videojuego extends Model
{
    /* use SoftDeletes; */

    use HasFactory;

    public $table = 'videojuegos';
    public $timestamps = false;
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'dissenyador',
        'plataforma'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'dissenyador' => 'string',
        'plataforma' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required|string|max:200',
        'dissenyador' => 'required|string|max:200',
        'plataforma' => 'required|string|max:200'
    ];

    
}
