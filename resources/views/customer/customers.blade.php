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
            <li class="breadcrumb-item active"><span>Customers</span></li>
          </ol>
        </nav>
    </div>
</header>


<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_customer_form" enctype="multipart/form-data">
      {{-- @csrf --}}
      <div class="modal-body p-4 bg-light">
        <div class="my-2">
            <label for="customer_id">Customer ID</label>
            <input type="text" name="customer_id" class="form-control" placeholder="Customer ID">
        </div>
        <div class="my-2">
            <label for="name">Customer Name</label>
            <input type="text" name="name" class="form-control" placeholder="Customer Name" required>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="phone">Contact No.</label>
            <input type="text" name="phone" class="form-control" placeholder="Contact No." required>
          </div>
          <div class="col-lg">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Address" required>
          </div>
          <div class="col-lg">
            <label for="country">Customer's Country</label>
            <input type="text" name="country" class="form-control" placeholder="Customer's Country" required>
          </div>
        </div>
        <div class="my-2">
            <label for="nid">Select NID Image</label>
            <input type="file" name="nid" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_customer_btn" class="btn btn-primary">Add Customer</button>
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
            <h3 class="text-light">Manage Customers</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addCustomerModal"><i
                class="bi-plus-circle me-2"></i>Add New Customer</button>
          </div>
          <div class="card-body" id="show_all_customers">
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


    fetchAllCustomers();
    //fetch all engineers
    function fetchAllCustomers()
    {
        $.ajax({
            url: 'fetch_all_customers',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_customers").html(res);
              }
        });
    }


    //add engineer ajax request
    $(document).on('submit', '#add_customer_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            // console.log(fd);
            $("#add_customer_btn").text('Adding...');
            $.ajax({
                method: 'post',
                url: '{{ route('customer.store') }}',
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
                            'Customer Added Successfully!',
                            'success'
                        );
                        fetchAllCustomers();
                    }
                    $("#add_customer_btn").text('Add Customer');
                    $("#add_customer_form")[0].reset();
                    $("#addCustomerModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
