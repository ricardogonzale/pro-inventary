<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_inventario
 * @property string $date
 * @property float $quantity
 * @property int $equipment_id
 * @property int $warehouse_id
 * @property string $type
 * @property string $detail
 * @property int $transfer_id
 * @property float $price
 * @property int $id_invoice
 * @property int $sub_project
 * @property int $warehouse_final
 * @property int $id_code
 * @property boolean $rent
 * @property int $id_invoice_tranfer
 * @property int $id_company
 * @property string $created_at
 * @property string $updated_at
 */
class Inventory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'inventory';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_inventario';

    /**
     * @var array
     */
    protected $fillable = ['date', 'quantity', 'equipment_id', 'warehouse_id', 'type', 'detail', 'transfer_id', 'price', 'id_invoice', 'sub_project', 'warehouse_final', 'id_code', 'rent', 'id_invoice_tranfer', 'id_company', 'created_at', 'updated_at'];
}
