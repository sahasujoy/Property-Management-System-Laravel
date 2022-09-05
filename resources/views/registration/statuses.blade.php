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
                <span>Registrations</span>
            </li>
            <li class="breadcrumb-item active"><span>Registration Statuses</span></li>
          </ol>
        </nav>
    </div>
</header>

<div class="modal fade" id="addStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Status</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_status_form">
      {{-- @csrf --}}
      <div class="modal-body p-4 bg-light">
        <div class="row">
            <div class="col-lg">
                <label for="registration_id">File No.</label>
                <select name="registration_id" class="form-control">
                    <option selected>Select a File No.</option>
                    @foreach ($registrations as $regitem)
                        <option value="{{ $regitem->id }}">{{ $regitem->file_no }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg">
                <label for="booking_date">Customer's Booking Date</label>
                <input type="date" name="booking_date" class="form-control" placeholder="Customer's Booking Date" required>
            </div>
        </div>
        <div class="my-2">
            <label for="land_status">Customer Land Registration Status</label>
            <select name="land_status" class="form-control">
                <option selected>Select a Status</option>
                <option value="Complete">Complete</option>
                <option value="Pending">Pending</option>
                <option value="Not Processing">Not Processing</option>
                <option value="Not Applicable">Not Applicable</option>
            </select>
        </div>
        <div class="my-2">
            <label for="flat_status">Customer Flat Registration Status</label>
            <select name="flat_status" class="form-control">
                <option selected>Select a Status</option>
                <option value="Complete">Complete</option>
                <option value="Pending">Pending</option>
                <option value="Not Processing">Not Processing</option>
                <option value="Not Applicable">Not Applicable</option>
            </select>
        </div>
        <div class="my-2">
            <label for="mutation_status">Customer Mutation Cost Status</label>
            <select name="mutation_status" class="form-control">
                <option selected>Select a Status</option>
                <option value="Complete">Complete</option>
                <option value="Pending">Pending</option>
                <option value="Not Processing">Not Processing</option>
                <option value="Not Applicable">Not Applicable</option>
            </select>
        </div>
        <div class="my-2">
            <label for="poa_status">Customer Power of Attorney Cost Status</label>
            <select name="poa_status" class="form-control">
                <option selected>Select a Status</option>
                <option value="Complete">Complete</option>
                <option value="Pending">Pending</option>
                <option value="Not Processing">Not Processing</option>
                <option value="Not Applicable">Not Applicable</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_status_btn" class="btn btn-primary">Add Status</button>
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
            <h3 class="text-light">Manage Statuses</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addStatusModal"><i
                class="bi-plus-circle me-2"></i>Add New Status</button>
          </div>
          <div class="card-body" id="show_all_statuses">
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


    fetchAllStatuses();
    //fetch all flats
    function fetchAllStatuses()
    {
        $.ajax({
            url: '/fetch_all_statuses',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_statuses").html(res);
                //but image is not visible, to see image go to terminal and run the command> php artisan storage:link
                // use datatable
                $("table").DataTable();
              }
        });
    }


    //add flat ajax request
    $(document).on('submit', '#add_status_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            // console.log(fd);
            $("#add_status_btn").text('Adding...');
            $.ajax({
                method: 'post',
                url: '{{ route('registration.status.store') }}',
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
                            'Status Added Successfully!',
                            'success'
                        );
                        fetchAllStatuses();
                    }
                    $("#add_status_btn").text('Add Status');
                    $("#add_status_form")[0].reset();
                    $("#addStatusModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
