<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\menu;
class menuController extends Controller
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
    public function create_menu(Request $request)
    {

        $menu = menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'jenis' => $request->jenis,
            'stok' => $request->stok,
            'gambar' => $request->gambar,
            ]);
        
        return response()->json([
                'success' => true,
                'message' => 'Create menu Success',
                'menu'=>$menu,
                ]);
    }

    public function getallmenu(Request $request)
    {

        $menu = menu::all();
        
        return response()->json([
                'success' => true,
                'message' => 'get all menu Success',
                'menu'=>$menu,
                ]);
    }

    public function getmenubyid(Request $request)
    {

        $menu = menu::find($request->id_menu);
        
        return response()->json([
                'success' => true,
                'message' => 'get menu Success',
                'menu'=>$menu,
                ]);
    }
    
    public function deletemenu(Request $request)
    {

        $menu = menu::where('id_menu',$request->id_menu)->first();
        $menu->delete();
        return response()->json([
                'success' => true,
                'message' => 'delete menu Success',
                
                ]);
    }

    public function updatemenu(Request $request)
    {
        $id_menu = $request->id_menu;
        $nama_menu = $request -> nama_menu;
        $harga = $request -> harga;
        $jenis = $request -> jenis;
        $stok = $request -> stok;


        $menu = menu::where('id_menu',$id_menu);
        if($nama_menu){
            $menu->update([
                'nama_menu'=> $nama_menu
            ]);
        }

        if($harga){
            $menu->update([
                'harga'=> $harga
            ]);
        }

        if($jenis){
            $menu->update([
                'jenis'=> $jenis
            ]);
        }

        if($stok){
            $menu->update([
                'stok'=> $stok
            ]);
        }  
          return response()->json([
            'success' => true,
            'message' => 'name update success',
            
            ]);
        

    }
    //
}
