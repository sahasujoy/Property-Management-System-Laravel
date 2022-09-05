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
                <!-- if breadcrumb is single--><span>Client Payment & Due</span>
              </li>
            <li class="breadcrumb-item active"><span>Registration Payment & Due</span></li>
          </ol>
        </nav>
    </div>
</header>

<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h3 class="text-light">Registration Amount Payment & Due Details</h3>
          </div>
          <div class="card-body" id="show_all_dues">
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


    fetchAllRegDues();
    //fetch all engineers
    function fetchAllRegDues()
    {
        $.ajax({
            url: 'fetch_all_regdues',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_dues").html(res);
              }
        });
    }
    });
    </script>
    @endsection
