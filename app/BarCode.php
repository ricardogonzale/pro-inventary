<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_barcode
 * @property string $code
 * @property string $numberSerie
 * @property int $id_equipment
 * @property int $id_company
 * @property string $created_at
 * @property string $updated_at
 */
class BarCode extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bar_code';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_barcode';

    /**
     * @var array
     */
    protected $fillable = ['code', 'numberSerie', 'id_equipment', 'id_company', 'created_at', 'updated_at'];
}
