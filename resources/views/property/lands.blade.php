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
                <!-- if breadcrumb is single--><span>Property</span>
              </li>
            <li class="breadcrumb-item active"><span>Lands</span></li>
          </ol>
        </nav>
    </div>
</header>


<div class="modal fade" id="addLandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Land</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_land_form" enctype="multipart/form-data">
      {{-- @csrf --}}
      <div class="modal-body p-4 bg-light">
        <div class="my-2">
            <label for="mname">Mouza Name</label>
            <input type="text" name="mname" class="form-control" placeholder="Mouza Name" required>
        </div>
        <div class="my-2">
            <label for="size">Land Size</label>
            <input type="text" name="size" class="form-control" placeholder="Last Name" required>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="khatiyan">Khatiyan No.</label>
            <input type="text" name="kcs" class="form-control" placeholder="CS" required>
          </div>
          <div class="col-lg">
            <label for="khatiyan">Khatiyan No.</label>
            <input type="text" name="ksa" class="form-control" placeholder="SA" required>
          </div>
          <div class="col-lg">
            <label for="khatiyan">Khatiyan No.</label>
            <input type="text" name="krs" class="form-control" placeholder="RS" required>
          </div>
          <div class="col-lg">
            <label for="khatiyan">Khatiyan No.</label>
            <input type="text" name="kbs" class="form-control" placeholder="BS" required>
          </div>
        </div>
        <div class="row">
            <div class="col-lg">
              <label for="khatiyan">Daag No.</label>
              <input type="text" name="dcs" class="form-control" placeholder="CS" required>
            </div>
            <div class="col-lg">
              <label for="khatiyan">Daag No.</label>
              <input type="text" name="dsa" class="form-control" placeholder="SA" required>
            </div>
            <div class="col-lg">
              <label for="khatiyan">Daag No.</label>
              <input type="text" name="drs" class="form-control" placeholder="RS" required>
            </div>
            <div class="col-lg">
              <label for="khatiyan">Daag No.</label>
              <input type="text" name="dbs" class="form-control" placeholder="BS" required>
            </div>
        </div>
        <div class="my-2">
          <label for="post">Land Address</label>
          <input type="text" name="address" class="form-control" placeholder="Land Address" required>
        </div>
        <div class="my-2">
          <label for="image">Select Land Image</label>
          <input type="file" name="image" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_land_btn" class="btn btn-primary">Add Land</button>
      </div>
    </form>
  </div>
</div>
</div>


{{-- <div class="text ms-3">
    <b>Land List</b><a type="button" href="{{ url('/') }}" class="btn btn-ghost-dark mb-3 mt-2" style="margin-left: 1000px">Add Land</a>
</div> --}}

<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Lands</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addLandModal"><i
                class="bi-plus-circle me-2"></i>Add New Land</button>
          </div>
          <div class="card-body" id="show_all_lands">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-coreui-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>

<script>
    const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toast = new coreui.Toast(toastLiveExample)
    toast.show()
  })
}
</script> --}}
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    fetchAllLands();
    //fetch all engineers
    function fetchAllLands()
    {
        $.ajax({
            url: '/property/fetch_all_lands',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_lands").html(res);
                //but image is not visible, to see image go to terminal and run the command> php artisan storage:link
                // use datatable
                // $("table").DataTable({
                //     order: [0, 'desc']
                // });
              }
        });
    }

    // $.ajaxSetup({
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    //add engineer ajax request
    $(document).on('submit', '#add_land_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_land_btn").text('Adding...');
            $.ajax({
                method: 'post',
                url: '{{ route('land.store') }}',
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
                            'Land Added Successfully!',
                            'success'
                        );
                        fetchAllLands();
                    }
                    $("#add_land_btn").text('Add Land');
                    $("#add_land_form")[0].reset();
                    $("#addLandModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
