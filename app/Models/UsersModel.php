<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'phone', 'role_id', 'password', 'role', 'created_at', 'updated_at'];
}
