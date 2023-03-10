@extends('admin.layout')
@push('title')
  <title>sales</title>
@endpush
@section('container')
  <h1 class="mb-3">Sales </h1>

  <form method="POST" action="/storeSales">
    @csrf
    <label>Select Salesman:</label>
    <select name="salesman_id">
        @foreach($sales_man as $salesman)
            <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
        @endforeach
    </select>
    <br><br>
    <label>Select Products:</label> <br>
    @foreach($products as $product)
        <input type="checkbox" name="products[]" value="{{ $product->pro_code }}"> {{ $product->pro_name }}
        <input type="number" name="qty[]_{{ $product->id }}" placeholder="Quantity"> <br>
    @endforeach
    <br>
    <button type="submit">Submit</button>
</form>

@endsection
