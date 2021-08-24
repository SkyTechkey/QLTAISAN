<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $primary_key = 'id';
    public $timestamps = false;

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
