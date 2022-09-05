@extends('master')
@section('content')
<header>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
              <!-- if breadcrumb is single--><span>Home</span>
            </li>
            <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Client Payment List</span>
              </li>
            <li class="breadcrumb-item active"><span>Registration Payment</span></li>
          </ol>
        </nav>
    </div>
</header>


<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Payment</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_payment_form">
      {{-- @csrf --}}
      <div class="modal-body p-4 bg-light">
        <div class="my-2">
            <label for="registration_id">File No.</label>
                <select name="registration_id" class="form-control">
                    <option selected>Select a File No.</option>
                    @foreach ($registrations as $regitem)
                        <option value="{{ $regitem->id }}">{{ $regitem->file_no }}</option>
                    @endforeach
                </select>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="land_reg_cost">Land Registration Cost Payment</label>
            <input type="number" name="land_reg_cost" class="form-control" placeholder="Land Registration Cost Payment" required>
          </div>
          <div class="col-lg">
            <label for="mutation_cost">Mutation Cost Payment</label>
            <input type="number" name="mutation_cost" class="form-control" placeholder="Mutation Cost Payment" required>
          </div>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="flat_reg_cost">Flat Registration Cost Payment</label>
            <input type="number" name="flat_reg_cost" class="form-control" placeholder="Flat Registration Cost Payment" required>
          </div>
          <div class="col-lg">
            <label for="poa_cost">Power of Attorney Cost Payment</label>
            <input type="number" name="poa_cost" class="form-control" placeholder="Power of Attorney Cost Payment" required>
          </div>
        </div>
        <div class="row">
            <div class="col-lg">
              <label for="booking_money">Booking Money</label>
              <input type="number" name="booking_money" class="form-control" placeholder="Booking Money" required>
            </div>
            <div class="col-lg">
              <label for="downpayment">Downpayment Amount</label>
              <input type="number" name="downpayment" class="form-control" placeholder="Downpayment Amount" required>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <label for="land_piling_money1">Land Piling Money 1</label>
              <input type="number" name="land_piling_money1" class="form-control" placeholder="Land Piling Money 1" required>
            </div>
            <div class="col-lg">
              <label for="land_piling_money2">Land Piling Money 2</label>
              <input type="number" name="land_piling_money2" class="form-control" placeholder="Land Piling Money 2" required>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <label for="building_piling">Building Piling Amount</label>
              <input type="number" name="building_piling" class="form-control" placeholder="Building Piling Amount" required>
            </div>
            <div class="col-lg">
              <label for="first_roof_cast">First Roof Casting Amount</label>
              <input type="number" name="first_roof_cast" class="form-control" placeholder="First Roof Casting Amount" required>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <label for="top_roof_cast">Top Roof Casting Amount</label>
              <input type="number" name="top_roof_cast" class="form-control" placeholder="Top Roof Casting Amount" required>
            </div>
            <div class="col-lg">
              <label for="final_work_cost">Final Work Amount</label>
              <input type="number" name="final_work_cost" class="form-control" placeholder="Final Work Amount" required>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <label for="car_parking">Car Parking Cost</label>
              <input type="number" name="car_parking" class="form-control" placeholder="Car Parking Cost" required>
            </div>
            <div class="col-lg">
              <label for="installments">No. of Paid Installments</label>
              <input type="number" name="installments" class="form-control" placeholder="No. of Paid Installments" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_payment_btn" class="btn btn-primary">Add Payment</button>
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
            <h3 class="text-light">Manage Regirtration Payments</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addPaymentModal"><i
                class="bi-plus-circle me-2"></i>Add New Payment</button>
          </div>
          <div class="card-body" id="show_all_payments">
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


    fetchAllRegPayments();
    //fetch all engineers
    function fetchAllRegPayments()
    {
        $.ajax({
            url: 'fetch_all_regpayments',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_payments").html(res);
              }
        });
    }


    //add engineer ajax request
    $(document).on('submit', '#add_payment_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            // console.log(fd);
            $("#add_payment_btn").text('Adding...');
            $.ajax({
                method: 'post',
                url: '{{ route('payment.store') }}',
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
                            'Payment Added Successfully!',
                            'success'
                        );
                        fetchAllRegPayments();
                    }
                    $("#add_payment_btn").text('Add Payment');
                    $("#add_payment_form")[0].reset();
                    $("#addPaymentModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
