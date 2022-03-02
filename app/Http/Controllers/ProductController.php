<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =   DB::select("SELECT DISTINCT P.*,C.category_name, PI.cover as cover_image from products as P JOIN category_products as CP ON P.id=CP.product_id JOIN categories as C ON C.id=CP.category_id JOIN  (select DISTINCT(product_id),cover from product_images GROUP BY product_id order by product_id DESC) as   PI On PI.product_id = P.id");


        // dd($products);
        return view('admin.products.list', [
            'products'=> $products
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
        return view('admin.products.add',[
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


        // dd($data);

        $sqlQuery = DB::select('INSERT INTO products (name, stock, is_active, price) VALUES (?,?,?,?)',[$data['name'],$data['stock'],$data['is_active'],$data['price']] );

        $id =  DB::getPdo()->lastInsertId();

        $sqlQuery = DB::select('INSERT INTO category_products (category_id, product_id) VALUES (?,?)',[$data['parent_id'],$id] );
        // dd($id);


        if($sqlQuery == true){
            $message = "Product successfully inserted";
        }
        else{
            $message = $sqlQuery;
        }



        return redirect()->route('product.edit',$id)->with('message',$message);

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
        $product =  DB::select("SELECT P.*,C.category_name from products as P JOIN category_products as CP ON P.id=CP.product_id JOIN categories as C ON C.id=CP.category_id where P.id=".$id);

        // dd($product);
        return view('admin.products.edit', [
            'product'=> $product[0]
        ]);


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



    public function exportCsv(Request $request)
    {
     $fileName = 'products.csv';
     $tasks =   DB::select("SELECT DISTINCT P.*,C.category_name, PI.cover as cover_image from products as P JOIN category_products as CP ON P.id=CP.product_id JOIN categories as C ON C.id=CP.category_id JOIN  (select DISTINCT(product_id),cover from product_images GROUP BY product_id order by id DESC) as   PI On PI.product_id = P.id");

     $headers = array(
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

     $columns = array('Sr No.', 'Product Name', 'Category Name', 'Price', 'Stock', 'Created At Date', 'Cover Image');

     $callback = function() use($tasks, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        $i=1;
        foreach ($tasks as $task) {
            $row['Sr No.'] = $i;
            $row['Product Name']  = $task->name;
            $row['Category Name']  = $task->category_name;
            $row['Price']    = $task->price;
            $row['Stock']    = $task->stock;
            $row['Created At Date']  = $task->created_at;
            $row['Cover Image'] = $task->cover_image;
            $i++;

            fputcsv($file, array($row['Sr No.'], $row['Product Name'], $row['Category Name'], $row['Price'], $row['Stock'], $row['Created At Date'], $row['Cover Image']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
