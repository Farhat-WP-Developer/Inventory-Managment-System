@extends('admin.layout')
@push('title')
  <title>Sales Man</title>
@endpush
@section('container')
  <h1 class="mb-3">Sales Persons </h1>
  <button type="button" class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#formModal" data-backdrop="false">
    Add New
  </button>
  <a href="{{route('admin/sales')}}"><button class="btn btn-secondary">Duty Time</button></a>

  {{-- Table to show the sales man  --}}
  <table class="table table-bordered table-bordered table-striped text-center">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Basic Salary</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sales_persons as $man)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $man->name }}</td>
          <td>{{ $man->phone_number }}</td>
          <td>{{ $man->address }}</td>
          <td>{{ $man->basic_salary }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Add New Sales Man</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form code goes here -->
          <form action="/newSalesMan" method="POST">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-10">
                    <input name="phone_number" type="tel" class="form-control" id="phone_number" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input name="address" type="text" class="form-control" id="address" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="basic_salary" class="col-sm-2 col-form-label">Basic Salary</label>
                <div class="col-sm-10">
                    <input name="basic_salary" type="number" class="form-control" id="basic_salary" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="hire_date" class="col-sm-2 col-form-label">Hire Date</label>
                <div class="col-sm-10">
                    <input name="hire_date" type="date" class="form-control" id="hire_date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
        </div>

      </div>
    </div>
  </div>

  <style>
    .modal{
        background-color: rgba(0, 0, 0, 0.4);
    }
    .header-desktop{
        z-index: 0 !important;
    }
  </style>

{{-- sales_person->loan += (sold_stock_cost - recieved);

//sales_person->loan += Remaining;

sold_qty = out - in;

$cmn = sold_qty * per_ctn_incen;
$cmn->commission += $cmn;

Total_stock_cost = out * price_in_inventory table;
sold_of_cost = sold_qty * price_in_inventory table; --}}
@endsection
