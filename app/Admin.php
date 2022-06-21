<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey='admin_id';
    protected $fillable = [
        'admin_email',
        'admin_password',
        'admin_name',
        'admin_phone',
    ];
    
    public function role() {
        return $this->belongsToMany('App\Role');
    }
    public function getAuthPassword(){
        return $this->admin_password;
    }

    public function hasanyrole($role) {
        return null !== $this->role()->where('role_name',$role)->first();
    }

    public function hasrole($role) {
        return null !== $this->role()->where('role_name',$role)->first();
    }
}