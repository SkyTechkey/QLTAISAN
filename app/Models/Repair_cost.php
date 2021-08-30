<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair_cost extends Model
{
    use HasFactory;
    protected $table = 'repair_costs';
    protected $primary_key = 'id';
    public $timestamps = false;
}
