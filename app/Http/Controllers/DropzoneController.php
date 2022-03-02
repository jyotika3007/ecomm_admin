<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;



class DropzoneController extends Controller
{
    // public function dropzone()
    // {
    //     return view('dropzone-view');
    // }
    
    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request,$id)
    {
        $image = $request->file('file');
        $product_id = $id;

        // dd($product_id);

        // dd($image);



   
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('/storage/products/'),$imageName);


        $sqlQuery = DB::select('INSERT INTO product_images (product_id, cover) VALUES (?,?)',[$product_id,$imageName] );

        if($sqlQuery){
            return response()->json(['success'=>$imageName]);            
        }
        else{
            return response()->json(['success'=>'Something went wong. Try again']);
        }
   
    }
}
