@extends('admin.layout')
@push('title')
    <title>Daily report</title>
@endpush
@section('container')
<section class="vh-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Add New Record</h2>

              <form action="/store" method="POST">
                @csrf


                <div class="form-outline mb-4">
                    <label class="form-label" for="daily_expenses">Daily Expenses</label>
                  <input type="numer" id="daily_expenses" name="daily_expenses" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="daily_sale">Daily Sale</label>
                  <input type="numer" id="daily_sale" name="daily_sale" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="daily_profit">Daily Profit</label>
                  <input type="numer" id="daily_profit" name="daily_profit" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="daily_profit">Date</label>
                  <input type="date" id="date" name="date" class="form-control form-control-lg" />
                </div>

                    <input type="submit" class="btn btn-success" value="submit">
                   <span><a href="{{route('admin.dashboard')}}"><button type="button"
                    class="btn btn-danger">cancel</button></a></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
