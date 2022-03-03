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
                <th>Category </th>
                <th>Parent Category</th>
                <th>Cover Igame</th>
                <th>Created_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{  $category->category_name ?? ''  }}</td>
                <td>{{ $category->parent_name ?? '' }}</td>
                <td>@if($category->cover_image != '')
                 <img src="$category->cover_image" />
                 @endif
                </td>
                <td>{{ $category->created_at ?? '' }}</td>
            </tr>
            @endforeach
            
        </tbody>

    </table>
               
            </div>
        </div>
    </div>
</div>
@endsection
