@extends('admin.layout')
@push('title')
<title>edit</title>
@endpush
@section('container')
<section class="vh-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Edit Record</h2>

              <form action="/outInventoryUpdate/{{$posts->id}}" method="POST">
                @csrf
                <div class="form-outline mb-4">
                  <label class="form-label" for="inv_name">Name</label>
                  <input type="text" id="inv_name" name="inv_name" class="form-control form-control-lg"
                    value={{$posts->name}} />

                </div>

                {{-- <div class="form-outline mb-4">
                  <label class="form-label" for="inv_in">IN</label>
                  <input type="number" id="inv_in" name="inv_in" class="form-control form-control-lg" value="0" />

                </div> --}}
                
                <div class="form-outline mb-4">
                  <label class="form-label" for="inv_out">OUT</label>
                  <input type="number" id="inv_out" name="inv_out" class="form-control form-control-lg" value="0" />
                </div>
                {{--
                <div class="form-outline mb-4">
                  <label class="form-label" for="int_on_hand">On Hand</label>
                  <input type="number" id="int_on_hand" name="int_on_hand" class="form-control form-control-lg" disabled
                    value={{$posts->on_hand}} />
                </div> --}}


                <button type="submit" class="btn btn-success">submit</button>
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