<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model 
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $timestamps = false;
    protected $primaryKey = 'id_admin';
    public $table = "admin";
    protected $fillable = [
        'nama', 'email','password','token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function pemesanan(){
        return $this->hasMany(pemesanan::class, 'id_admin');
    }
}
