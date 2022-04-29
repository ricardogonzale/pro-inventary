<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $type
 * @property int $id_source
 * @property string $location
 * @property string $created_at
 * @property string $updated_at
 */
class Media extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['type', 'id_source', 'location', 'created_at', 'updated_at'];
}
