@extends('admin.layout')
@push('title')
    <title>weekly report</title>
@endpush
@section('container')
<div class="row">
    <div class="col-lg-10">
        <h1 class="mb-3">7 Days Report </h1>

    </div>
    <div class="col-lg-2">
        <a href="index">
            <button type="button" class="btn btn-success" id="add_record">Add Record</button>
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

        <table id="report-table">
            <thead>
          <tr>
            <th>#</th>
            <th>Date</th>
            <th>Daily Expenses</th>
            <th>Daily Sale</th>
            <th>Daily Profit</th>
            {{-- <th>Action</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($last7daysReports as $post)
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
        </tbody>

        </table>


    </div>

        <button type="button" onclick="printTable()" class="btn btn-success">Print OR Save</button>



    </div>
    <script>
        function printTable() {
            window.print({
                noPrintSelector:'add_record'
            });
        }



    </script>



    {{-- <script>
function printTable() {
    var table = document.getElementById("report-table");
    var printWindow = window.open('', '', 'height=400,width=800');
    printWindow.document.write('<html><head><title>Report Table</title>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}


    </script> --}}
@endsection
