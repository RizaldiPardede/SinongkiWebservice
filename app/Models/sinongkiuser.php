<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class sinongkiuser extends Model 
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $table = "user";
    public $timestamps = false;
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama', 'email','password','token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password','token'
    ];

    // public function pemesanan(){
    //     return $this->hasMany(pemesanan::class, 'id_user');
    // }
    //,'pemesanan','id_user','id_menu'

    // public function menu(){
    //     return $this->hasMany(menu::class,'pemesanan','id_user','id_menu','jumlah_pemesanan','total_harga','status');
    // }

//     public function menu()
//   {
//     return $this->belongsToMany(menu::class, 'pemesanan', 'id_menu', 'id_user');
//   }

  public function pemesanan()
  {
    return $this->hasMany(pemesanan::class, 'id_user');
  }
}
