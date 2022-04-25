<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_country
 * @property string $name
 */
class GeoProvince extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'geo_province';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id_country', 'name'];
}
