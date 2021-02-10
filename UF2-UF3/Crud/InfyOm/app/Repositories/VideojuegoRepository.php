<?php

namespace App\Repositories;

use App\Models\Videojuego;
use App\Repositories\BaseRepository;

/**
 * Class VideojuegoRepository
 * @package App\Repositories
 * @version February 10, 2021, 12:29 am UTC
*/

class VideojuegoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'autor',
        'plataforma'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Videojuego::class;
    }
}
