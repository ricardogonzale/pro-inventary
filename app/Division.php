<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_divicion_name
 * @property string $name
 * @property int $id_company
 * @property string $created_at
 * @property string $updated_at
 */
class Division extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'division';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_divicion_name';

    /**
     * @var array
     */
    protected $fillable = ['name', 'id_company', 'created_at', 'updated_at'];
}
