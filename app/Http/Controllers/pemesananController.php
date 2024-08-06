<?php


namespace App\Http\Controllers;
use App\Models\sinongkiuser;
use App\Models\menu;
use App\Models\admin;
use App\Models\pemesanan;
use App\Models\menu_pemesanan;

use Illuminate\Http\Request;


class pemesananController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createantrian(Request $request)
    {
        $pemesanan = pemesanan::create([
            'id_user'=>$request->id_user
        ]);
        return response()->json([
            'success' => true,
            'message' => $pemesanan,
        
        ]);
    }

    public function tambahmenu(Request $request)
    {   
        $nomor_antrian = $request->nomor_antrian;
        $id_menu = $request->id_menu;
        $pemesanan = pemesanan::where('nomor_antrian',$nomor_antrian)->first();
        $menu = menu::where('id_menu',$id_menu)->first();
        $jumlah_pesanan = $request->jumlah_pemesanan;
        $harga = $menu->harga;
        $total_harga = $jumlah_pesanan * $menu->harga;
        if($menu->stok <= 0){
            return response()->json([
                'success' => true,
                'message' => 'Stok habis',
            
            ]);
        }
        if($menu->stok < $jumlah_pesanan){
            return response()->json([
                'success' => true,
                'message' => 'Stok kurang',
            
            ]);
        }

        $menu->update([
            'stok'=>$menu->stok-$jumlah_pesanan
        ]);
        $pemesanan->menu()->attach($menu->id_menu);

        
        $menu_pemesanan = menu_pemesanan::findOrfail($pemesanan->nomor_antrian)->where('id_menu',$menu->id_menu);

        $menu_pemesanan->update([
            'jumlah'=>$jumlah_pesanan,
            'hargakalijumlah'=>$total_harga
        ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'All post grabbed',
        //     'data' => [
        //         $jumlah_pesanan,$total_harga 
        //     ]
        // ]);
        
        return response()->json([
            'success' => true,
            'pemesanan' => [
                'Nomor Antrian'=>$pemesanan->nomor_antrian,
                'User'=>$pemesanan->user,
                'pesanan'=>$pemesanan->load("menu_pemesanan.menu")
                
                ]
        
        ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'All post grabbed',
        //     'data' => [
        //         'user'=>$user->makeHidden(['menu']),
        //         'pesanan'=>$user->menu->makeHidden(['pivot','stok']),
        //         'total bayar'=>$user->menu->sum('harga')
        //     ]
        // ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Pemesanan Sukses',
        //     'Pemesanan'=> $menu
        //     ]);

        // $pemesanan = pemesanan::create([
        //     'id_user'=>$user->id_user,
        //     'id_menu'=>$menu->id_menu,
        //     'jumlah_pemesanan'=>$jumlah_pesanan,
        //     'total_harga'=> $total_harga,
        //     'status'=>'On Proses'

        // ]);



        

        // $pemesanan = pemesanan::create([
        //     'jumlah_pemesanan'=> $jumlah_pesanan,
        //     'total_harga'=> $total_harga,
        //     'status	'=>'proses',


        // ]);

        
        



        // return response()->json([
        //     'success' => true,
        //     'message' => 'Pemesanan Sukses',
        //     'Pemesanan'=> [
        //         'user'=>$user,
        //         'menu'=>$menu,
        //         $pemesanan,
        //     ]
        //     ]);
        
        // $user->menu()->attach($menu->id_menu);

        // $pemesanan= pemesanan::where('id_user',$user->id_user);
        
        // $pemesanan->update([
        //     'jumlah_pesanan'=>$jumlah_pesanan,
        //     'total_harga'=> $total_harga
        // ]);
        


        
    }

    public function getallpesanan()
    {   

        $pemesanan = pemesanan::with('user','menu_pemesanan.menu')->get();
        
        return response()->json([
            'success' => true,
            'pemesanan' => $pemesanan
        
        ]);
        // return response()->json([
        //     'success' => true,
        //     'pemesanan' => [
        //         'Nomor Antrian'=>$pemesanan->nomor_antrian,
        //         'User'=>$pemesanan->user,
        //         'pesanan'=>$pemesanan->menu->makeHidden(['pivot','stok']),]
        
        // ]);
    }
    
    public function getpesananuser(Request $request)
    {   

        $pemesanan = pemesanan::where('id_user',$request->id_user)->with("menu_pemesanan.menu","user")->get();

        
        return response()->json([
            'success' => true,
            'pemesanan' => $pemesanan,
            

        
        ]);
        // return response()->json([
        //     'success' => true,
        //     'pemesanan' => [
        //         'Nomor Antrian'=>$pemesanan->nomor_antrian,
        //         'User'=>$pemesanan->user,
        //         'pesanan'=>$pemesanan->menu->makeHidden(['pivot','stok']),]
        
        // ]);
    }

    public function hapusmenu(Request $request)
    {   $id_menu = $request->id_menu;
        $nomor_antrian = $request->nomor_antrian;
        $pemesanan = pemesanan::findOrfail($nomor_antrian);
        $menu_pemesanan = menu_pemesanan::where("nomor_antrian", $nomor_antrian)->where('id_menu',$id_menu)->first();
        $menu = menu::findOrfail($id_menu);
        $updatestok = $menu->stok+$menu_pemesanan->jumlah;
        $menu->update([
            'stok'=>$updatestok
        ]);
        $pemesanan->menu()->detach($id_menu);
        if( count($pemesanan->menu) <= 0){
            $delete = pemesanan::where('nomor_antrian',$nomor_antrian)->first();
            $delete->delete();

        }
        return response()->json([
            'success' => true,
            'pemesanan' => 'Delete Menu success'
        
        ]);

        

        
    }

    public function hapuspemesanan(Request $request)
    { 
        $nomor_antrian = $request->nomor_antrian;
        $pemesanan = pemesanan::where('nomor_antrian',$nomor_antrian)->first();
        $pemesanan->delete();
        return response()->json([
            'success' => true,
            'pemesanan' => 'Delete Pemesanan success',
            'status pemesanan'=>'selesai'
        
        ]);

        

        
    }
    //
}
