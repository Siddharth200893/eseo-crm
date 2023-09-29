<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModeModel extends Model
{

    protected $table = 'payment_modes';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'currency_id', 'user_id', 'created_at', 'updated_at'];
}
