<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::orderBy('created_at','DESC')->get();

        $categories = DB::select("SELECT C1.*,C2.category_name as parent_name from categories as C1 LEFT JOIN categories as C2 ON C1.parent_id=C2.id order by C1.created_at");

        // dd($categories);

        return view('admin.categories.list',[
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = DB::select("SELECT * from categories where parent_id=0 order by category_name");
        return view('admin.categories.add',[
            'categories' => $categories
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token','_method']);

        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            $filename = time().".".$file->getClientOriginalExtension();
            $file = move('/storage/categories/',$filename);
            $data['cover_image'] = $filename;
        }
        else{
            $data['cover_image'] = '';
        }


if(!isset($data['parent_id'])){
    $data['parent_id'] = 0;
}
        // dd($data);

        $sqlQuery = DB::statement('INSERT INTO categories (category_name, cover_image, is_active, parent_id) VALUES (?,?,?,?)',[$data['category_name'],$data['cover_image'],$data['is_active'],$data['parent_id']] );

        if($sqlQuery == true){
            $message = "Category successfully inserted";
        }
        else{
            $message = $sqlQuery;
        }


        return redirect('/category')->with('message',$message);

        // dd($sqlQuery);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getSubCateList(Request $request){
        $data = $request->all();

         $categories = DB::select("SELECT * from categories where parent_id=".$data['id']." order by created_at");

        // dd($categories);


        return response()->json([
            'sub_categories'=> $categories
        ]);
    }


    public function getCategoryProducts(Request $request){

        $categories = DB::select("SELECT C.category_name, count(CP.product_id) as total_products , sum(P.stock) as stock FROM categories as C LEFT JOIN category_products as CP ON C.id=CP.category_id LEFT JOIN products as P ON P.id = CP.product_id Group By C.id");

        // dd($categories);

        return view('admin.category-product.list', [

            'categories' => $categories
        ]);
    }



}
