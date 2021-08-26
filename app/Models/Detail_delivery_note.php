<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_delivery_note extends Model
{
    use HasFactory;
    protected $table = 'detail_delivery_notes';
    protected $primary_key = 'id';
    public $timestamps = false;
}
