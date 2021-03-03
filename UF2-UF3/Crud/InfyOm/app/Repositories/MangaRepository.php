<?php

namespace App\Repositories;

use App\Models\Manga;
use App\Repositories\BaseRepository;

/**
 * Class MangaRepository
 * @package App\Repositories
 * @version February 25, 2021, 2:06 pm UTC
*/

class MangaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'editorial'
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
        return Manga::class;
    }
}
