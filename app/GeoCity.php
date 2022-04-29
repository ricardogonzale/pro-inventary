<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_state
 * @property string $name
 * @property State $state
 */
class GeoCity extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'geo_city';

    /**
     * @var array
     */
    protected $fillable = ['id_state', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State', 'id_state');
    }
}
