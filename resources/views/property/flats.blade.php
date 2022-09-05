@extends('master')
@section('content')
<header>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item">
                <span>Property</span>
            </li>
            <li class="breadcrumb-item active"><span>Flats</span></li>
          </ol>
        </nav>
    </div>
</header>

<div class="modal fade" id="addFlatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Flat</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_flat_form" enctype="multipart/form-data">
      {{-- @csrf --}}
      <div class="modal-body p-4 bg-light">
        <div class="my-2">
            <label for="building_id">Building Name</label>
            <select name="building_id" class="form-control">
                <option selected>Select a Building</option>
                @foreach ($buildings as $buildingitem)
                    <option value="{{ $buildingitem->id }}">{{ $buildingitem->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="my-2">
            <label for="no">Flat No.</label>
            <input type="text" name="no" class="form-control" placeholder="Flat No." required>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="floor">Flat Floor No.</label>
            <input type="text" name="floor" class="form-control" placeholder="Flat Floor No." required>
          </div>
          <div class="col-lg">
            <label for="face_direction">Flat Face Direction</label>
            <input type="text" name="face_direction" class="form-control" placeholder="Flat Face Direction" required>
          </div>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="size">Flat Size</label>
            <input type="text" name="size" class="form-control" placeholder="Flat Size" required>
          </div>
          <div class="my-2">
            <label for="sell_status">Sell Status</label>
            <select name="sell_status" class="form-control">
                <option selected>Select a Sell Status</option>
                <option value="Sold">Sold</option>
                <option value="Unsold">Unsold</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_flat_btn" class="btn btn-primary">Add Flat</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Flats</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addFlatModal"><i
                class="bi-plus-circle me-2"></i>Add New Flat</button>
          </div>
          <div class="card-body" id="show_all_flats">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    fetchAllFlats();
    //fetch all flats
    function fetchAllFlats()
    {
        $.ajax({
            url: '/property/fetch_all_flats',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_flats").html(res);
                //but image is not visible, to see image go to terminal and run the command> php artisan storage:link
                // use datatable
                $("table").DataTable();
              }
        });
    }


    //add flat ajax request
    $(document).on('submit', '#add_flat_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            // console.log(fd);
            $("#add_flat_btn").text('Adding...');
            $.ajax({
                method: 'post',
                url: '{{ route('flat.store') }}',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res)
                {
                    // console.log(res);
                    if(res.status == 200)
                    {
                        Swal.fire(
                            'Added!',
                            'Flat Added Successfully!',
                            'success'
                        );
                        fetchAllFlats();
                    }
                    $("#add_flat_btn").text('Add Flat');
                    $("#add_flat_form")[0].reset();
                    $("#addFlatModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
