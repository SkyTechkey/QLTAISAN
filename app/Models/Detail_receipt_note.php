<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_receipt_note extends Model
{
    use HasFactory;
    protected $table = 'detail_receipt_notes';
    protected $primary_key = 'id';
    public $timestamps = false;
}
