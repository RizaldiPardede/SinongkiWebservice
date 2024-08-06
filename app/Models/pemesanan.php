<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model 
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $table = "pemesanan";
    protected $primaryKey = 'nomor_antrian';
    protected $fillable = [
        'nomor_antrian','id_user','id_menu'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'jumlah_pemesanan','total_harga','status'
    ];

    //,'status', 'jumlah_pemesanan','total_harga'

    // public function user(){
    // return $this->belongsTo(sinongkiuser::class, 'id_user');
    // }

    // public function menu(){
    //     return $this->belongsTo(menu::class, 'id_menu');
    // }

    public function user()
  {
    return $this->belongsTo(sinongkiuser::class, 'id_user');
  }
    public function menu()
  {
    return $this->belongsToMany(menu::class, 'menu_pemesanan', 'nomor_antrian', 'id_menu');
  }

  public function menu_pemesanan()
  {
    return $this->hasMany(menu_pemesanan::class, 'nomor_antrian');
  }
  
}
