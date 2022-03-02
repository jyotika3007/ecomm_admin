@extends('layouts.app')

@section('navbar')
@include('admin.includes.navbar')
@endsection

@section('content')



<div class="container">
@include('admin.includes.errors-and-messages')
    <div class="row justify-content-center">
        <h2>Categories List</h2>
        <div class="col-md-12">

            
            <div class="card">
            	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name </th>
                <th>Total Product</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id ?? '0' }}</td>
                <td>{{ $category->category_name ?? ''  }}</td>
                <td>{{ $category->total_products ?? '' }}</td>
                <td>{{ $category->stock ?? '0' }}</td>
               
            </tr>
            @endforeach
            
        </tbody>

    </table>
               
            </div>
        </div>
    </div>
</div>
@endsection
