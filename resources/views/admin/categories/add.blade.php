@extends('layouts.app')

@section('navbar')
@include('admin.includes.navbar')
@endsection

@section('content')
<div class="container">
				<form class="form-horizontal" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"> 
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<h2>Add New Category</h2>
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label col-sm-2" for="category_name">Category Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" name="category_name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="cover_image">Cover Image (Optional):</label>
						<div class="col-sm-10">          
							<input type="file" class="form-control" id="cover_image" placeholder="Enter password" name="cover_image">
						</div>
					</div> 
					<div class="form-group">
						<label class="control-label col-sm-2" for="is_active">Status:</label>
						<div class="col-sm-10">          
							<select class="form-control" id="is_active" name="is_active" >

								<option value="1">Enable</option>
								<option value="0">Disable</option>

							</select>
						</div>
					</div>

					<div class="form-group">        
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</div>
			</div>
		</div>


		<div class="col-md-4">
			<h2> Parent Category </h2>
				<ul>
			@foreach($categories as $category)
					<li style="position : relative"><input type="checkbox" value="{{ $category->id }}" name="parent_id"  /> &nbsp{{ $category->category_name ?? '' }} <span style="position: absolute; right: 0; cursor: pointer"> <i class="fa fa-angle-down" onclick="getChildCategories({{ $category->id }})"></i> </span><div id="subList{{$category->id}}"></div></li>
			@endforeach
				</ul>

		</div>

				</form>
	</div>
</div>
@endsection


@section('script')

<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>	

@endsection
