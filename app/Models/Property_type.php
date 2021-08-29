<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_type extends Model
{
    use HasFactory;
    protected $table = 'property_type';
    protected $primary_key = 'id';
    public $timestamps = false;
    public function asset()
    {
        return $this->hasMany(Asset::class);
    }
}
