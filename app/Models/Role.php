<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable = [
       'name'
    ];
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    private function hasPermission(string $permission) : bool
    {
        foreach($this->permissions as $per){
            if($per->name == $permission){
                return true;
            }
        }
        return false;
    }
}
