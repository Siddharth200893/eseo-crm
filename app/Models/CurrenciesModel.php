<?php

namespace App\Models;

use CodeIgniter\Model;

class CurrenciesModel extends Model
{

    protected $table = 'currencies ';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'user_id', 'created_at',  'updated_at'];
}
