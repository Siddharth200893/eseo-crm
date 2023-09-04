<?php

namespace App\Models;

use CodeIgniter\Model;

class projectsModel extends Model
{

    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'user_id', 'created_at', 'updated_at'];
}
