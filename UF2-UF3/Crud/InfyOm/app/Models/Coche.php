<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Coche
 * @package App\Models
 * @version February 24, 2021, 3:14 pm UTC
 *
 * @property integer $id
 * @property string $nombre
 * @property string $marca
 */
class Coche extends Model
{
    /* use SoftDeletes; */

    use HasFactory;

    public $table = 'coches';
    public $timestamps = false;
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'nombre',
        'marca'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'marca' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:200',
        'marca' => 'required|string|max:200'
    ];

    
}
