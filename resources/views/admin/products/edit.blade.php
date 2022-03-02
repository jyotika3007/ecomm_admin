@extends('layouts.app')

@section('navbar')
@include('admin.includes.navbar')
@endsection

@section('css')

<link  href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css"  rel="stylesheet">  

<script  src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">

			<ul class="nav nav-tabs">
				<li><a data-toggle="tab" href="#home">Edit Product</a></li>
				<li class="active"><a data-toggle="tab" href="#menu1">Cover Images</a></li>
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane">
					<form class="form-horizontal" action="{{ route('product.store') }}" method="POST"> 

						<div class="row">							

							<div class="col-sm-8">
								<div class="card">
									<h2>Edit Product</h2>
									{{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-sm-2" for="name">Product Name:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="name" value="{{ $product->name ?? '' }}" placeholder="Enter Product Name" name="name" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-2" for="price">Price:</label>
										<div class="col-sm-10">
											<input type="number" step="0.1" class="form-control" id="price" placeholder="Enter Product Price" name="price" required="required"  value="{{ $product->price ?? '' }}">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-2" for="stock">Quantity (In Stock):</label>
										<div class="col-sm-10">
											<input type="number" class="form-control" id="stock" placeholder="Enter Stock " name="stock" required="required" value="{{ $product->stock ?? '' }}">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-2" for="is_active">Status:</label>
										<div class="col-sm-10">          
											<select class="form-control" id="is_active" name="is_active" >

												<option value="1" @if($product->is_active == 1)'selected'@endif>Enable</option>
												<option value="0" @if($product->is_active == 0)'selected'@endif>Disable</option>

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
									<li>{{ $product->category_name ?? ''}}</li>
								</ul>

							</div>

						</div>

					</form>
				</div>
				<div id="menu1" class="tab-pane fade in active">
					<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Upload Multiple Images using dropzone.js and Laravel</h4>
            <form id="image-upload" action="{{ route('dropzone.store',$product->id) }}" method="POST" enctype="multipart/form-data" class="dropzone form-control">

            	{{ csrf_field() }}
            	
            <div>
                <h5>Upload Multiple Image By Click On Box</h5>
            </div>
            
            </form>
           
        </div>
    </div>
</div>
				</div>

			</div>


		</div>


	</div>
</div>
@endsection


@section('script')

<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>	

<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>

@endsection
