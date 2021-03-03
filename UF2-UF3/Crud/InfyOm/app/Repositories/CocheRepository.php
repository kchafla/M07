<?php

namespace App\Repositories;

use App\Models\Coche;
use App\Repositories\BaseRepository;

/**
 * Class CocheRepository
 * @package App\Repositories
 * @version February 24, 2021, 3:14 pm UTC
*/

class CocheRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nombre',
        'marca'
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
        return Coche::class;
    }
}
