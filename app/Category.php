<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_category
 * @property string $name
 * @property string $type
 * @property int $id_user
 * @property int $id_company
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'category';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_category';

    /**
     * @var array
     */
    protected $fillable = ['name', 'type', 'id_user', 'id_company', 'created_at', 'updated_at'];
}
