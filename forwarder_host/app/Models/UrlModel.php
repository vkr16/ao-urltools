<?php

namespace App\Models;

use CodeIgniter\Model;

class UrlModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'urls';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'long_url', 'short_url', 'hits', 'creator_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'int';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
