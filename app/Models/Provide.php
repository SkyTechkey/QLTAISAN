<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provide extends Model
{
    use HasFactory;
    protected $table = 'provide';
    protected $primary_key = 'id';
    public $timestamps = false;
}
