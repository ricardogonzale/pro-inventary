<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_country
 * @property string $name
 */
class GeoState extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'geo_state';

    /**
     * @var array
     */
    protected $fillable = ['id_country', 'name'];
}
