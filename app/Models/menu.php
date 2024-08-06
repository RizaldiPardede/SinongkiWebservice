<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class menu extends Model 
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $timestamps = false;
    public $table = "menu";
    protected $primaryKey = 'id_menu';
    protected $fillable = [
        'nama_menu', 'harga','jenis','stok','gambar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'pivot'
    ];

    // public function pemesanan(){
    //     return $this->hasMany(pemesanan::class, 'id_menu');
    // }

    //,'pemesanan','id_user','id_menu'

    // public function user(){
    //     return $this->hasMany(sinongkiuser::class,'pemesanan','id_user','id_menu','jumlah_pemesanan','total_harga','status');
    // }
    public function pemesanan()
  {
    return $this->belongsToMany(pemesanan::class, 'menu_pemesanan', 'nomor_antrian', 'id_menu');
  }

}
