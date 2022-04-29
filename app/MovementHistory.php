<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tranfer
 * @property string $date
 * @property int $equipment_id
 * @property int $quantity
 * @property int $warehouse_id_origin
 * @property int $warehouse_id_destination
 * @property int $warehouse_id_final
 * @property string $resp_id
 * @property int $transfer_invoice_id
 * @property int $stock
 * @property int $status
 * @property string $detail
 * @property int $id_code
 * @property string $rent
 * @property int $id_invoice
 * @property int $id_company
 */
class MovementHistory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'movement_history';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tranfer';

    /**
     * @var array
     */
    protected $fillable = ['date', 'equipment_id', 'quantity', 'warehouse_id_origin', 'warehouse_id_destination', 'warehouse_id_final', 'resp_id', 'transfer_invoice_id', 'stock', 'status', 'detail', 'id_code', 'rent', 'id_invoice', 'id_company'];
}
