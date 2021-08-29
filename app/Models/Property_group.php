<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_group extends Model
{
    use HasFactory;
    protected $table = 'property_group';
    protected $primary_key = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
    public function asset()
    {
        return $this->hasMany(Asset::class);
    }
}
