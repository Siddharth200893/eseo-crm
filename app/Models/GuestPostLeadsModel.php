<?php

namespace App\Models;

use CodeIgniter\Model;

class GuestPostLeadsModel extends Model
{

    protected $table = 'guestpost_leads';
    protected $primaryKey = 'id';

    protected $allowedFields = ['link', 'project_id', 'role_id', 'user_id', 'amount', 'currency', 'payment_mode', 'payment_status', 'payment_approvel', 'reference_number', 'created_at', 'updated_at'];
}
