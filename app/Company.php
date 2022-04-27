<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_company
 * @property string $company_name
 * @property string $email
 * @property string $phone
 * @property string $status
 * @property int $id_user
 */
class Company extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'company';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_company';

    /**
     * @var array
     */
    protected $fillable = ['company_name', 'email', 'phone', 'status', 'id_user'];
}
