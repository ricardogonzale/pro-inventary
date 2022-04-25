<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $lastaname
 * @property string $email
 * @property string $telephone
 * @property int $country
 * @property string $tradename
 * @property string $logistic_address
 * @property string $cif
 * @property int $province
 * @property string $activity_memory
 * @property string $activity
 * @property string $created_at
 * @property string $updated_at
 */
class Client extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'client';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'name', 'lastaname', 'email', 'telephone', 'country', 'tradename', 'logistic_address', 'cif', 'province', 'activity_memory', 'activity', 'created_at', 'updated_at'];
}
