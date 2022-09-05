@extends('master')
@section('content')
<div class="container">
<h3>Building & Flat Customer Details</h3>
<h5><u>Details</u></h5>
<div class="row">
    <div class="col-lg">
        <label for="">Building Name</label>
        <input type="text" value="{{ $building->name }}" class="form-control">
    </div>
    <div class="col-lg">
        <label for="">Road No.</label>
        <input type="text" value="{{ $building->road_no }}" class="form-control">
    </div>
    <div class="col-lg">
        <label for="">Building Number</label>
        <input type="text" value="{{ $building->no }}" class="form-control">
    </div>
    <div class="col-lg">
        <label for="">Building Face Direction</label>
        <input type="text" value="{{ $building->face_direction }}" class="form-control">
    </div>
    <div class="col-lg">
        <label for="">Building Location</label>
        <input type="text" value="{{ $building->location }}" class="form-control">
    </div>
</div>
<br>

<form action="{{ route('bnf.filter') }}" method="post">
@csrf
<div class="row">
    <div class="col-md-1">
    Filter By
    </div>
    <div class="col-md-2">
    <input name="building_id" value="{{ $building->id }}" hidden>
    <select name="sell_status" id="" class="form-control">
        <option value="" selected>Select</option>
        <option value="Sold">Sold</option>
        <option value="Unsold">Unsold</option>
    </select>
    </div>
    <div class="col-md-2">
    <button type="submit" class="btn btn-secondary">Filter</button>
    </div>
</div>
</form>
<br>
<br>
<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-body">
            <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th scope="col">Country Name</th>
                    <th scope="col">Customer's Name</th>
                    <th scope="col">Customer's ID</th>
                    <th scope="col">File No.</th>
                    <th scope="col">Flat Number</th>
                    <th scope="col">Flat Floor No.</th>
                    <th scope="col">Flat Face Direction</th>
                    <th scope="col">Flat Size</th>
                    <th scope="col">Sell Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($flats as $item)
                    <tr>
                        <td>{{ optional($item->registrations)->customers->country }}</td>
                        <td>{{ optional($item->registrations)->customers->name }}</td>
                        <td>{{ optional($item->registrations)->customers->customer_id }}</td>
                        <td>{{ optional($item->registrations)->file_no }}</td>
                        <td>{{ $item->no }}</td>
                        <td>{{ $item->floor }}</td>
                        <td>{{ $item->face_direction }}</td>
                        <td>{{ $item->size }}</td>
                        <td>{{ $item->sell_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
