<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Welcome</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{ url('/home') }}">Dashboard</a></li>
      <li><a href="{{ route('category.index') }}">Categories List</a></li>
      <li><a href="{{ route('category.create') }}">ADD Category</a></li>
      <li><a href="{{ route('product.index') }}">Products List</a></li>
      <li><a href="{{ route('product.create') }}">Add Product</a></li>
      <li><a href="{{ route('category.products') }}">Categorywise Products List</a></li>
    </ul>
    <ul class="float-right">
      <li>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button type="submit" name="Logout" class="btn btn-primary">Logout</button>
                    </form>

      </li>
      <li style="margin-top: 15px"><a href="#"></a> <i class="fa fa-user"></i> {{ Auth::user()->name }}</li>
    </ul>      
  </div>
</nav>

<style type="text/css">
    .float-right{
      list-style-type: none;
      color: #fff;
    }
    .float-right li{
      float: right;
      margin-top: 7px;
      margin-right: 10px
    }
</style>
  