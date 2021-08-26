<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery_note extends Model
{
    use HasFactory;
    protected $table = 'delivery_notes';
    protected $primary_key = 'id';
    public $timestamps = false;
}
