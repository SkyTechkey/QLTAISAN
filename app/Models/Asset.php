<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'assets';
    protected $primary_key = 'id';
    public $timestamps = false;

    public function property_group()
    {
        return $this->belongsTo('App\Models\Property_group');
    }
    public function property_type()
    {
        return $this->belongsTo('App\Models\Property_type');
    }
    public function provide()
    {
        return $this->belongsTo('App\Models\Provide');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
