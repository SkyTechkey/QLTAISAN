<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets_details extends Model
{
    use HasFactory;

    protected $table = 'assets_details';
    protected $primary_key = 'id';
    public $timestamps = false;
}
