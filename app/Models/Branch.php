<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branches';
    protected $primary_key = 'id';
    public $timestamps = false;

    public function department()
    {
        return $this->hasMany(Department::class);
    }
}
