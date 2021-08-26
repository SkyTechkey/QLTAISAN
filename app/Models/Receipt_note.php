<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt_note extends Model
{
    use HasFactory;
    protected $table = 'receipt_notes';
    protected $primary_key = 'id';
    public $timestamps = false;
}
