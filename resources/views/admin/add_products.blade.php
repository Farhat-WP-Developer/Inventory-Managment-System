@extends('admin.layout')
@push('title')
  <title>Add Products</title>
@endpush
@section('container')
  <h1 class="mb-3">Add Products</h1>
  {{-- {{$trk_number}} --}}
  <div class="row">
    <div class="col-sm-5">
      <form action="/addProduct" method="POST" id="productForm">
        @csrf
        <div class="card border-success mb-3">
          <div class="card-header bg-success text-white">IN</div>
          <div class="card-body">
            {{-- <label for="product_name">Select a product:</label>
                    <select name="product_name" id="product_name">
                        @foreach ($products as $product)
                        <option value="{{ $product->pro_code}}">{{ $product->pro_name }}</option>
                        @endforeach
                    </select>
                    <br><br> --}}
            <label for="product">Select Product</label> <br>
            <select name="product_code" id="product_code" class="mx-2">
              @foreach ($products as $product)
                <option value="{{ $product->pro_code }}">{{ $product->pro_code . ' ' . $product->pro_name }}
                </option>
              @endforeach
            </select>
            <br><br>
            <div id="myForm">
              <div class="input-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="border border-secondary mx-1" required>
              </div>
            </div>
            <button type="submit" id="addBtn" onclick="showTable()" class="btn btn-success mt-2">Add</button>
            <a href="{{ route('admin.newProductShow') }}"><button type="button"
                class="btn btn-primary mt-2">New</button></a>
          </div>
        </div>
      </form>
      <a href="{{ route('admin.dashboard') }}"><button class="btn btn-secondary pb-3 pr-5 pl-5 pt-3 mb-5" onclick="hideTable()">save
          all</button></a>
    </div>
    <div class="col-7">
      <table class="table table-bordered table-bordered table-striped" id="myTable" >
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>

          </tr>
        </thead>
        <tbody>
            <?php
            $new = DB::table('trucks')
            ->join('products', 'trucks.trk_number', '=', 'products.trk_number')
            ->where('trucks.created_at', '=', DB::raw('(select max(created_at) from trucks)'))
            ->select('trucks.*', 'products.*')
            ->get();
            ?>


            @foreach ($new as $key => $data)
            <tr>
                <td>{{$loop->iteration}}</td>

            <td>{{$data->pro_id}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->in}}</td>
        </tr>

            @endforeach


        </tbody>
      </table>

      <script>



       function showTable()
        {
            document.getElementById("myTable").style.display = "table";

        }

        function hideTable()
        {
            document.getElementById("myTable").style.display = "none";

        }



      </script>





    </div>
  </div>
@endsection
