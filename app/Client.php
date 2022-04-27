<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $address
 * @property string $img
 * @property boolean $active
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
    protected $fillable = ['id_user', 'name', 'email', 'telephone', 'fax', 'address', 'img', 'active', 'created_at', 'updated_at'];
}
