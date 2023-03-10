@extends('admin.layout')
@push('title')
<title>Add Products</title>
@endpush
@section('container')
<h1 class="mb-3">Add Products</h1>
{{-- to add new product when not available in the total inventories table --}}
<form action="/newProduct" method="post">
    @csrf
    <div class="form-group">
        <label for="productCodeInput">Product Code</label>
        <input type="text" class="form-control" name="productCodeInput" id="productCodeInput" placeholder="Enter product code">
      </div>
      <div class="form-group">
        <label for="productNameInput">Product Name</label>
        <input type="text" class="form-control" name="productNameInput" id="productNameInput" placeholder="Enter product name">
      </div>
      <div class="form-group">
        <label for="productPriceInput">Product Price Per Cutton</label>
        <input type="number" class="form-control" name="productPriceInput" id="productPriceInput" placeholder="Enter product price per cutton">
      </div>
      <div class="form-group">
        <label for="productQuantityInput">Product Quantity</label>
        <input type="number" class="form-control" name="productQuantityInput" id="productQuantityInput" placeholder="Enter product quantity">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('admin.showProduct')}}"><button type="button" class="btn btn-danger">cancel</button></a>
</form>
@endsection
