@extends('layouts.app')

@section('navbar')
@include('admin.includes.navbar')
@endsection



@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">

			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Add Product</a></li>
				<!-- <li><a data-toggle="tab" href="#menu1">Add Images</a></li> -->
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<form class="form-horizontal" action="{{ route('product.store') }}" method="POST"> 

						<div class="row">							

							<div class="col-sm-8">
								<div class="card">
									<h2>Add New Product</h2>
									{{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-sm-2" for="name">Product Name:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="name" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-2" for="price">Price:</label>
										<div class="col-sm-10">
											<input type="number" step="0.1" class="form-control" id="price" placeholder="Enter Product Price" name="price" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-2" for="stock">Quantity (In Stock):</label>
										<div class="col-sm-10">
											<input type="number" class="form-control" id="stock" placeholder="Enter Stock " name="stock" required="required">
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

						</div>

					</form>
				</div>
				<div id="menu1" class="tab-pane fade">
					<h3>Menu 1</h3>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>

			</div>


		</div>


	</div>
</div>
@endsection


@section('script')

<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>	

@endsection
