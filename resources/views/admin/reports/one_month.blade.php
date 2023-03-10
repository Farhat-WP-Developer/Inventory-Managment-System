@extends('admin.layout')
@push('title')
    <title>one month report</title>
@endpush
@section('container')
<div class="row">
    <div class="col-lg-10">
        <h1 class="mb-3">Monthly Report </h1>
    </div>

    <div class="col-lg-2">
        <a href="index">
            <button type="button" class="btn btn-success">Add Record</button>
        </a>
    </div>

</div>
<div class="row">
    <div class="table-responsive table--no-card m-b-40">

    <style>
        table {
          border-collapse: collapse;
          width: 100%;
          /* border: 1px solid; */
        }


        th, td {
          text-align: center;
          padding: 8px;
          /* border: 1px solid; */
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
          background-color: #4caf50;
          color: white;
        }
        </style>

        <table>
          <tr>
            <th>#</th>
            <th>Date</th>
            <th>Daily Expenses</th>
            <th>Daily Sale</th>
            <th>Daily Profit</th>
            {{-- <th>Action</th> --}}
          </tr>
          @foreach ($last30daysReports as $post)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$post->date}}</td>
            <td>{{$post->daily_expenses}}</td>
            <td>{{$post->daily_sale}}</td>
            <td>{{$post->daily_profit}}</td>

          </tr>
          @endforeach
 {{-- <td>{{$post->on_hand}}</td> --}}
            {{-- <td><a href="/admin/edit/{{$post->id}}" class="btn btn-success">IN</a><span><a href="/admin/out_inv/{{$post->id}}" class="btn btn-danger mx-3">OUT</a></span></td> --}}
          <tr>
            <th></th>
            <th>Total</th>
            <th>{{$data->daily_expenses}}</th>
            <th>{{$data->daily_sale}}</th>
            <th>{{$data->daily_profit}}</th>

          </tr>

        </table>


    </div>

        <button type="button" class="btn btn-success" onclick="printTable()">print OR save</button>

    {{-- <a href="add_expenses">
        <button type="button" class="btn btn-success mx-3">send</button>
    </a> --}}

    </div>

    <script>
        function printTable() {
            window.print();
        }



    </script>
@endsection
