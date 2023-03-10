@extends('admin.layout')

{{-- title of the page --}}
@push('title')
  <title>Dashboard</title>
@endpush
{{-- end title of the page --}}

@section('container')
  <h1 class="mb-3">Dashboard </h1>

  <?php
  // changes in total inventories table
  $data = DB::table('total_inventories')->update(['total_cost' => DB::raw('total_qty * per_price')]);

  //changes in salesperson table using formulas to update the data in the columns
  $data = DB::table('sales_persons')->update(['total_salary' => DB::raw('basic_salary + commission_rate - loan')]);
  $data = DB::table('sales')->update(['sold_stock_qty' => DB::raw('stock_out - stock_in')]);
  $data = DB::table('sales')->update(['sold_stock_cost' => DB::raw('stock_out_cost - stock_in_cost')]);
  ?>


{{-- change incentives and change price buttons --}}
  <button type="button" class="btn btn-primary  float-right mb-2" data-toggle="modal" data-target="#incentivesModel"
    data-backdrop="false">
    Change Incentive
  </button>
  <button type="button" class="btn btn-primary float-right mb-2 mr-2" data-toggle="modal" data-target="#myModal"
    data-backdrop="false">
    Change Price
  </button>
  {{-- end of buttons  --}}


  <!-- Modal  for changing price-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Change Price Per Cutton</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="updateForm">
            <div class="form-group">
              <label for="product">Product</label>
              <select class="form-control" id="product" name="product">
                <option value="">Select a product</option>
                @foreach ($posts_data as $product)
                  <option value="{{ $product->id }}">{{ $product->pro_code . ' ' . $product->pro_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="Enter new price">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- end of chnage price modal --}}

  {{-- update price of the product in dashboard having the button "change price" --}}
  <script>
    // Handle form submission
    $('#updateForm').submit(function(e) {
      e.preventDefault();

      // Get the product ID and the new price from the form
      var productId = $('#product').val();
      var price = $('#price').val();

      // Send the product ID and the new price to the server using an AJAX request
      $.ajax({
        url: '/update-price',
        type: 'POST',
        data: {
          productId: productId,
          price: price,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          // Display a success message
          //   alert('Product price updated successfully');
          //   console.log('right or not');
          location.reload();
        }
      });
    });
  </script>

  <!-- Modal  for changing incentives-->
  <div class="modal fade" id="incentivesModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Change Incentives Per Cutton</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="updateFormForIncentives">
            <div class="form-group">
              <label for="product">Product</label>
              <select class="form-control" id="productIncentive" name="productIncentive">
                <option value="">Select a product</option>
                @foreach ($posts_data as $product)
                  <option value="{{ $product->id }}">{{ $product->pro_code . ' ' . $product->pro_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="priceIncentive">Incentive</label>
              <input type="text" class="form-control" id="priceIncentive" name="priceIncentive"
                placeholder="Enter new price">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- end of chnage incentives modal --}}

  <script>
    // Handle form submission for incentives
    $('#updateFormForIncentives').submit(function(e) {
      e.preventDefault();

      // Get the product ID and the new price from the form
      var productId = $('#productIncentive').val();
      var price = $('#priceIncentive').val();

      // Send the product ID and the new price to the server using an AJAX request
      $.ajax({
        url: '/update-incentive',
        type: 'POST',
        data: {
          productId: productId,
          price: price,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          // Display a success message
          //   alert('Product price updated successfully');
          //   console.log('right or not');
          location.reload();
        }
      });
    });
  </script>

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      /* border: 1px solid; */
    }

    th,
    td {
      text-align: center;
      padding: 8px;
      /* border: 1px solid; */
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4caf50;
      color: white;
    }
  </style>


  {{-- <h3 class="text-center">On Hand Stock</h3> --}}

  <table>
    <tr>
      <th>#</th>
      <th>Code</th>
      <th>Name</th>
      <th>On Hand</th>
      <th>Price</th>
      <th>Incentive</th>
      {{-- <th>OUT</th> --}}
      <th>SubTotal</th>
      {{-- <th>Action</th> --}}
    </tr>
    @foreach ($posts_data as $post)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $post->pro_code }}</td>
        <td>{{ $post->pro_name }}</td>
        <td>{{ $post->total_qty }}</td>
        <td>{{ $post->per_price }}</td>
        <td>{{ $post->per_incentive }}</td>
        <td>{{ $post->total_cost }}</td>

        {{-- <td><a href="/admin/edit/{{$post->id}}" class="btn btn-success">IN</a><span><a
                    href="/admin/out_inv/{{$post->id}}" class="btn btn-danger mx-3">OUT</a></span></td> --}}
      </tr>
    @endforeach


  </table>
  {{-- <div class="pagination text-center">
    {{$posts_data->links()}}
</div>
<style>
    .pagination>li>a,
    .pagination>li>span {
        background-color: #ff0000;
    }
</style> --}}


  <h3 class="text-center mt-5">Last Truck</h3>
  <table class="table table-bordered table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Truck Number</th>
        <th scope="col">Truck Name</th>
        <th scope="col">Driver</th>
        <th>Action</th>
        {{-- <th></th> --}}
      </tr>
    </thead>
    <tbody>


      <tr>
        <td>{{ $latestTrkNumber->trk_number }}</td>
        <td>{{ $latestTrkNumber->trk_name }}</td>
        <td>{{ $latestTrkNumber->driver_name }}</td>
        <td><button id="modal-button"><i class="fas fa-thin fa-eye"></i></button></td>
        {{-- <td></td> --}}
      </tr>

    </tbody>
  </table>

  <!-- Modal to show the latest truck details -->
  <div id="modal" class="modal mt-5">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close-button">&times;</span>
      <h1>Last Truck Details</h1>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-5">
            <?php
            $data = DB::table('trucks')
                ->latest()
                ->first();
            // foreach($data as $row) {
            //   echo $row->driver_name . '<br>';
            // }
            // $spaces = sprintf('%10s', '');
            echo 'Truck Number : ' . $data->trk_number . '<br>';
            echo 'Truck Name : ' . $data->trk_name . '<br>';
            echo 'Driver Name : ' . $data->driver_name . '<br><br>';

            echo '<h3>Returns</h3> <br>';
            echo 'Pilots : ' . $data->pilots . '<br>';
            echo 'Shells : ' . $data->shells . '<br>';
            echo 'Empty : ' . $data->empty . '<br>';
            ?>
          </div>
          <div class="col-md-7">
            <?php
            $new = DB::table('trucks')
                ->join('products', 'trucks.trk_number', '=', 'products.trk_number')
                ->where('trucks.created_at', '=', DB::raw('(select max(created_at) from trucks)'))
                ->select('trucks.*', 'products.*')
                ->get();
            ?>
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Product Quantity</th>
                </tr>
              </thead>
              @foreach ($new as $key => $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->pro_id }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->in }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <style>
    /* Style the modal of latest truck */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
      margin-top: 75px !important;
      padding-top: 40px;
    }

    /* Style the modal content */
    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      border: 1px solid #888;
      width: 80%;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -webkit-animation-name: animatetop;
      -webkit-animation-duration: 0.4s;
      animation-name: animatetop;
      animation-duration: 0.4s
    }

    /* Add animation */
    @-webkit-keyframes animatetop {
      from {
        top: -300px;
        opacity: 0
      }

      to {
        top: 0;
        opacity: 1
      }
    }

    @keyframes animatetop {
      from {
        top: -300px;
        opacity: 0
      }

      to {
        top: 0;
        opacity: 1
      }
    }

    /* Style the close button */
    .close-button {
      color: white;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close-button:hover,
    .close-button:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
  </style>

  <script>
    // Get the modal and button elements
    var modal = document.getElementById("modal");
    var button = document.getElementById("modal-button");

    // Get the close button element
    var closeButton = document.getElementsByClassName("close-button")[0];

    // When the user clicks the button, open the modal
    button.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks the close button, close the modal
    closeButton.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

{{-- Yesterday reports --}}
<h3 class="text-center mt-5">Yesterday Report</h3>
<table class="table table-bordered table-bordered table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Sale</th>
      <th scope="col">Expenses</th>
      <th>Profit</th>
      {{-- <th></th> --}}
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{ $latestReport->date }}</td>
      <td>{{ $latestReport->daily_sale }}</td>
      <td>{{ $latestReport->daily_expenses }}</td>
      <td>{{ $latestReport->daily_profit }}</td>
    </tr>
  </tbody>
</table>
@endsection
