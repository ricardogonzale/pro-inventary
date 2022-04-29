<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_equipment
 * @property int $id_category
 * @property string $name
 * @property string $barCode
 * @property int $stock
 * @property float $price
 * @property int $stock_min
 * @property int $id_company
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class Equipment extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_equipment';

    /**
     * @var array
     */
    protected $fillable = ['id_category', 'name', 'barCode', 'stock', 'price', 'stock_min', 'id_company', 'id_user', 'created_at', 'updated_at'];
}
