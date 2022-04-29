<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_invoice
 * @property string $order
 * @property float $total
 * @property string $img_invoice
 * @property string $date
 * @property int $id_warehouse
 * @property float $tax
 * @property float $subtotal
 * @property string $invoice_client
 * @property string $store_name
 * @property float $shipping_costs
 * @property string $type
 * @property int $id_rent_suppl
 * @property string $type_move
 * @property int $id_company
 * @property string $created_at
 * @property string $updated_at
 */
class Invoice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'invoice';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_invoice';

    /**
     * @var array
     */
    protected $fillable = ['order', 'total', 'img_invoice', 'date', 'id_warehouse', 'tax', 'subtotal', 'invoice_client', 'store_name', 'shipping_costs', 'type', 'id_rent_suppl', 'type_move', 'id_company', 'created_at', 'updated_at'];
}
