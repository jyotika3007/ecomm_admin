@extends('layouts.app')

@section('navbar')
@include('admin.includes.navbar')
@endsection

@section('content')



<div class="container">
@include('admin.includes.errors-and-messages')
    <div class="row justify-content-center">
        <h2>Products List

            <span style="margin-left: 75%" id="export" data-href="/tasks" class="btn btn-warning btn-sm" onclick="exportTasks(event.target);">Export</span>

        </h2>


        <div class="col-md-12">
            <div class="card">
            	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name </th>
                <th>Category</th>
                <th>Stock</th>
                <th>Cover Image</th>
                <th>Created_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $product->name ?? ''  }}</td>
                <td>{{ $product->category_name ?? '' }}</td>
                <td>{{ $product->stock ?? '' }}</td>
                <td>@if($product->cover_image != '')
                 <img src="{{asset('/storage/products/'.$product->cover_image)}}" style="height: 100px ; width: auto" />
                 @endif
                </td>
                <td>{{ $product->created_at ?? '' }}</td>
            </tr>
            @endforeach
            
        </tbody>

    </table>
               
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script>
   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;


      // $.ajax({
      //   type: "GET",
      //   data: {},
      //   url: '/tasks',
      //   success:function(response){
      //       console.log(response)
      //   }
      // })



   }
</script>

@endsection
