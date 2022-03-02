@extends('layouts.app')

@section('navbar')
@include('admin.includes.navbar')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="text-align: center">
               <h1 style=" font-size: 64px; font-weight: 900">Welcome to Dashboard</h1>
            </div>
        </div>
    </div>
</div>
@endsection
