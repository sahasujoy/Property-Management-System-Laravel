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
                <!-- if breadcrumb is single--><span>Client Price Information</span>
              </li>
            <li class="breadcrumb-item active"><span>Registered Flat Prices</span></li>
          </ol>
        </nav>
    </div>
</header>


<div class="modal fade" id="addPriceModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Price</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_price_form">
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
            <label for="land_reg_cost">Land Registration Cost</label>
            <input type="number" name="land_reg_cost" class="form-control" placeholder="Land Registration Cost" required>
          </div>
          <div class="col-lg">
            <label for="mutation_cost">Mutation Cost</label>
            <input type="number" name="mutation_cost" class="form-control" placeholder="Mutation Cost" required>
          </div>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="flat_reg_cost">Flat Registration Cost</label>
            <input type="number" name="flat_reg_cost" class="form-control" placeholder="Flat Registration Cost" required>
          </div>
          <div class="col-lg">
            <label for="poa_cost">Power of Attorney Cost</label>
            <input type="number" name="poa_cost" class="form-control" placeholder="Power of Attorney Cost" required>
          </div>
        </div>
        <div class="row">
            <div class="col-lg">
              <label for="flat_price">Flat Price</label>
              <input type="number" name="flat_price" class="form-control" placeholder="Flat Price" required>
            </div>
            <div class="col-lg">
              <label for="utility_charge">Utility Charge</label>
              <input type="number" name="utility_charge" class="form-control" placeholder="Utility Charge" required>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <label for="car_parking">Car Parking Charge</label>
              <input type="number" name="car_parking" class="form-control" placeholder="Car Parking Charge" required>
            </div>
            <div class="col-lg">
              <label for="additional_cost">Additional Cost</label>
              <input type="number" name="additional_cost" class="form-control" placeholder="Additional Cost" required>
            </div>
          </div>
          <div class="my-2">
            <label for="installments">No. of Installments</label>
            <input type="number" name="installments" class="form_control" placeholder="No. of Installments" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_price_btn" class="btn btn-primary">Add Price</button>
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
            <h3 class="text-light">Manage Flat Prices</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addPriceModal"><i
                class="bi-plus-circle me-2"></i>Add New Price</button>
          </div>
          <div class="card-body" id="show_all_prices">
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


    fetchAllFlatPrices();
    //fetch all engineers
    function fetchAllFlatPrices()
    {
        $.ajax({
            url: 'fetch_all_flatprices',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_prices").html(res);
              }
        });
    }


    //add engineer ajax request
    $(document).on('submit', '#add_price_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            // console.log(fd);
            $("#add_price_btn").text('Adding...');
            $.ajax({
                method: 'post',
                url: '{{ route('price.store') }}',
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
                            'Price Added Successfully!',
                            'success'
                        );
                        fetchAllFlatPrices();
                    }
                    $("#add_price_btn").text('Add Price');
                    $("#add_price_form")[0].reset();
                    $("#addPriceModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
