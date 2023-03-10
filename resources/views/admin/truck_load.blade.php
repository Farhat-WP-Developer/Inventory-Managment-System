@extends('admin.layout')
@push('title')
<title>Truck</title>
@endpush
@section('container')
  <h1 class="mb-3">Truck Entry</h1>
  <div class="container mt-5">
    <div class="border border-secondary p-3 shadow ">
      <form action="/store_truck" method="POST" enctype="">
        @csrf
        <div class="row">
          {{-- Truck details --}}
          <div class="col-sm-6">
            <div class="card border-primary mb-3">
              <div class="card-header bg-primary text-white">Truck Details</div>
              <div class="card-body">
                <div class="form-outline mb-4">
                  <label class="form-label" for="drvr_name">Truck Driver</label>
                  <input type="numer" id="drvr_name" name="drvr_name" class="form-control form-control-lg"
                    placeholder="e.g. Asad Ali" required />
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="trk_name">Truck Name</label>
                  <input type="numer" id="trk_name" name="trk_name" class="form-control form-control-lg"
                    placeholder="e.g. FM" required />
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="trk_nmbr">Truck Number</label>
                  <input type="text" id="trk_nmbr" name="trk_nmbr" class="form-control form-control-lg"
                    placeholder="e.g. G-657" required />
                </div>
              </div>
            </div>
          </div>
          {{-- return  --}}
          <div class="col-sm-6">
            <div class="card border-danger mb-3">
              <div class="card-header bg-danger text-white">Return</div>
              <div class="card-body">
                <div class="form-outline mb-4">
                  <label class="form-label" for="pilots">Pilots</label>
                  <input type="numer" id="pilots" name="pilots" class="form-control form-control-lg" value="0" />
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="shells">Shells</label>
                  <input type="numer" id="shells" name="shells" class="form-control form-control-lg" value="0" />
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="empty">Empty</label>
                  <input type="numer" id="empty" name="empty" class="form-control form-control-lg" value="0" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="buttons text-right">
          <a href="{{route('admin.dashboard')}}"><button type="button" class="btn btn-secondary">cancel</button></a>
          <a href="#"><button type="submit" class="btn btn-primary mr-2 ">Save & Next</button></a>
        </div>
      </form>
    </div>
  </div>
@endsection
