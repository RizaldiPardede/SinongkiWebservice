<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu_pemesanan extends Model 
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $table = "menu_pemesanan";
    protected $fillable = [
        'id','id_menu','nomor_antrian','jumlah','hargakalijumlah'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        
    ];

    public function pemesanan()
  {
    return $this->belongsTo(pemesanan::class, 'nomor_antrian');
  }
    
  public function menu()
  {
    return $this->belongsTo(menu::class, 'id_menu');
  }
    
  
}
