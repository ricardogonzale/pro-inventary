<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $id_project
 * @property int $id_truck
 * @property int $id_main_warehouses
 * @property int $id_rent_suppl
 * @property boolean $status
 * @property int $id_clients
 */
class Warehouses extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'type', 'id_project', 'id_truck', 'id_main_warehouses', 'id_rent_suppl', 'status', 'id_clients'];
}
