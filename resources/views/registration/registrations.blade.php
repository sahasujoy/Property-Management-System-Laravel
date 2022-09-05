@extends('master')
@section('content')
<header>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
              <!-- if breadcrumb is single--><span>Home</span>
            </li>
            {{-- <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Property</span>
              </li> --}}
            <li class="breadcrumb-item active"><span>Registrations</span></li>
          </ol>
        </nav>
    </div>
</header>


<div class="modal fade" id="addRegistrationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Registration</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_registration_form">
      {{-- @csrf --}}
      <div class="modal-body p-4 bg-light">
        <div class="my-2">
            <label for="file_no">File No.</label>
            <input type="text" name="file_no" class="form-control" placeholder="File No.">
        </div>
        <div class="my-2">
            <label for="customer_id">Customer ID</label>
            <select name="customer_id" class="form-control">
                <option selected>Select a Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->customer_id }}</option>
                @endforeach
            </select>
        </div>
        <div class="my-2">
            <label for="flat_id">Flat No.</label>
            <select name="flat_id" class="form-control">
                <option selected>Select a Flat</option>
                @foreach ($flats as $flat)
                    <option value="{{ $flat->id }}">{{ $flat->no }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="date">Flat Registration Date</label>
            <input type="date" name="date" class="form-control" placeholder="Flat Registration Date" required>
          </div>
          <div class="col-lg">
            <label for="sub_deed_no">Flat Reg. Sub-Deed No.</label>
            <input type="text" name="sub_deed_no" class="form-control" placeholder="Flat Reg. Sub-Deed No." required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_registration_btn" class="btn btn-primary">Add Registration</button>
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
            <h3 class="text-light">Manage Flat Registrations</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addRegistrationModal"><i
                class="bi-plus-circle me-2"></i>Add New Registration</button>
          </div>
          <div class="card-body" id="show_all_registrations">
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


    fetchAllRegistrations();
    //fetch all engineers
    function fetchAllRegistrations()
    {
        $.ajax({
            url: 'fetch_all_registrations',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_registrations").html(res);
              }
        });
    }


    //add engineer ajax request
    $(document).on('submit', '#add_registration_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            console.log(fd);
            $("#add_registration_btn").text('Adding...');
            $.ajax({
                method: 'post',
                url: '{{ route('registration.store') }}',
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
                            'Registration Added Successfully!',
                            'success'
                        );
                        fetchAllRegistrations();
                    }
                    $("#add_registration_btn").text('Add Registration');
                    $("#add_registration_form")[0].reset();
                    $("#addRegistrationModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
