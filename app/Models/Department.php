<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $primary_key = 'id';
    public $timestamps = false;
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
