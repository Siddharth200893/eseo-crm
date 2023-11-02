<?php

namespace App\Models;

use CodeIgniter\Model;

class GuestPostLeadsModel extends Model
{

    protected $table = 'guestpost_leads';
    protected $primaryKey = 'id';

    protected $allowedFields = ['link', 'project_id', 'role_id', 'user_id', 'currency_id', 'payment_mode_id', 'amount', 'agent_email', 'blogger_name', 'blogger_email', 'blogger_phone', 'payment_status', 'is_flag', 'payee_email', 'payee_number', 'payment_approvel', 'reference_number', 'created_at', 'updated_at', 'account_no', 'account_name', 'ifsc_code'];
}
