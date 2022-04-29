<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $warehouse_id_origin
 * @property int $warehouse_id_destination
 * @property int $warehouse_id_final
 * @property string $date
 * @property int $status
 * @property int $transfer_in
 * @property string $type
 * @property string $resp_id
 * @property int $btn
 * @property int $id_clients
 */
class TransferInvoice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transfer_invoice';

    /**
     * @var array
     */
    protected $fillable = ['warehouse_id_origin', 'warehouse_id_destination', 'warehouse_id_final', 'date', 'status', 'transfer_in', 'type', 'resp_id', 'btn', 'id_clients'];
}
