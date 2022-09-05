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
            <li class="breadcrumb-item active"><span>Buildings</span></li>
          </ol>
        </nav>
    </div>
</header>


<div class="modal fade" id="addBuildingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Building</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_building_form"">
      {{-- @csrf --}}
      <div class="modal-body p-4 bg-light">
        <div class="my-2">
            <label for="land_id">Land Mouza Name</label>
            <select name="land_id" class="form-control">
                <option selected>Select a land</option>
                @foreach ($lands as $landitem)
                    <option value="{{ $landitem->id }}">{{ $landitem->mouza_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="my-2">
            <label for="name">Building Name</label>
            <input type="text" name="name" class="form-control" placeholder="Building Name" required>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="road_no">Road No.</label>
            <input type="text" name="road_no" class="form-control" placeholder="Road No." required>
          </div>
          <div class="col-lg">
            <label for="no">Building No.</label>
            <input type="text" name="no" class="form-control" placeholder="Building No." required>
          </div>
        </div>
        <div class="row">
            <div class="col-lg">
              <label for="face_direction">Building Face Direction</label>
              <input type="text" name="face_direction" class="form-control" placeholder="Building Face Direction" required>
            </div>
            <div class="col-lg">
              <label for="location">Building Location</label>
              <input type="text" name="location" class="form-control" placeholder="Building Location" required>
            </div>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="floors">Total Number of Floors</label>
            <input type="text" name="floors" class="form-control" placeholder="Total Number of Floors" required>
          </div>
          <div class="col-lg">
            <label for="flats">Total Number of Flats</label>
            <input type="text" name="flats" class="form-control" placeholder="Total Number of Flats" required>
          </div>
        </div>
        <div class="row">
            <div class="col-lg">
              <label for="start_date">Work Start Date</label>
              <input type="date" name="start_date" class="form-control" placeholder="Work Start Date" required>
            </div>
            <div class="col-lg">
              <label for="complete_date">Work Complete Date</label>
              <input type="date" name="complete_date" class="form-control" placeholder="Work Complete Date" required>
            </div>
        </div>
        <div class="my-2">
            <label for="complete_extended_date">Work Complete Extended Date</label>
            <input type="date" name="complete_extended_date" class="form-control" placeholder="Work Complete Extended Date" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_building_btn" class="btn btn-primary">Add Building</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade" id="editBuildingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Building</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="edit_building_form">
      @csrf
      <input type="hidden" name="building_id" id="building_id">
      <div class="modal-body p-4 bg-light">
        <div class="my-2">
            <label for="land_id">Land Mouza Name</label>
            <select name="land_id" id="land_id" class="form-control">
                <option selected>Select a land</option>
                @foreach ($lands as $landitem)
                    <option value="{{ $landitem->id }}">{{ $landitem->mouza_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="my-2">
            <label for="name">Building Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Building Name" required>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="road_no">Road No.</label>
            <input type="text" name="road_no" id="road_no" class="form-control" placeholder="Road No." required>
          </div>
          <div class="col-lg">
            <label for="no">Building No.</label>
            <input type="text" name="no" id="no" class="form-control" placeholder="Building No." required>
          </div>
        </div>
        <div class="row">
            <div class="col-lg">
              <label for="face_direction">Building Face Direction</label>
              <input type="text" name="face_direction" id="face_direction" class="form-control" placeholder="Building Face Direction" required>
            </div>
            <div class="col-lg">
              <label for="location">Building Location</label>
              <input type="text" name="location" id="location" class="form-control" placeholder="Building Location" required>
            </div>
        </div>
        <div class="row">
          <div class="col-lg">
            <label for="floors">Total Number of Floors</label>
            <input type="text" name="floors" id="floors" class="form-control" placeholder="Total Number of Floors" required>
          </div>
          <div class="col-lg">
            <label for="flats">Total Number of Flats</label>
            <input type="text" name="flats" id="flats" class="form-control" placeholder="Total Number of Flats" required>
          </div>
        </div>
        <div class="row">
            <div class="col-lg">
              <label for="start_date">Work Start Date</label>
              <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Work Start Date" required>
            </div>
            <div class="col-lg">
              <label for="complete_date">Work Complete Date</label>
              <input type="date" name="complete_date" id="complete_date" class="form-control" placeholder="Work Complete Date" required>
            </div>
        </div>
        <div class="my-2">
            <label for="complete_extended_date">Work Complete Extended Date</label>
            <input type="date" name="complete_extended_date" id="complete_extended_date" class="form-control" placeholder="Work Complete Extended Date" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="edit_building_btn" class="btn btn-success">Update Building</button>
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
            <h3 class="text-light">Manage Buildings</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBuildingModal"><i
                class="bi-plus-circle me-2"></i>Add New Building</button>
          </div>
          <div class="card-body" id="show_all_buildings">
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


    fetchAllBuildings();
    //fetch all buildings
    function fetchAllBuildings()
    {
        $.ajax({
            url: '/property/fetch_all_buildings',
            method: 'get',
            success: function (res) {
                console.log(res);
                $("#show_all_buildings").html(res);
                //but image is not visible, to see image go to terminal and run the command> php artisan storage:link
                // use datatable
                // $("table").DataTable({
                //     order: [0, 'desc']
                // });
              }
        });
    }

     //delete engineer ajax request
     $(document).on('click', '.deleteIcon', function (e) {
          e.preventDefault();
          let id = $(this).attr('id');
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('building.delete') }}',
              method: 'post',
              data: {
                id: id,
                _token: '{{ csrf_token() }}'
              },
              success: function(response)
              {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                fetchAllBuildings();
              }
            });
          }
         });
        });
        //update building ajax request
        $("#edit_building_form").submit(function(e){
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_building_btn").text('Updating...');
            $.ajax({
                url: "{{ route('building.update') }}",
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    // console.log(response);
                    if(response.status == 200)
                    {
                        Swal.fire(
                            'Updated!',
                            'Building Data Updated Successfully!',
                            'success'
                        );
                        fetchAllBuildings();
                    }
                    $("#edit_building_btn").text('Update Building');
                    $("#edit_building_form")[0].reset();
                    $("#editBuildingModal").modal('hide');
                }
            });
        });
        //edit building ajax request
        $(document).on('click', '.editIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
            $.ajax({
                url: "{{ route('building.edit') }}",
                method: 'get',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    // console.log(response);
                    $('#land_id').val(response.land_id);
                    $('#name').val(response.name);
                    $('#road_no').val(response.road_no);
                    $('#no').val(response.no);
                    $('#face_direction').val(response.face_direction);
                    $('#location').val(response.location);
                    $('#floors').val(response.floors);
                    $('#flats').val(response.flats);
                    $('#start_date').val(response.start_date);
                    $('#complete_date').val(response.complete_date);
                    $('#complete_extended_date').val(response.complete_extended_date);
                    $('#building_id').val(response.id);
                }
            });
        });

    //add building ajax request
    $(document).on('submit', '#add_building_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            // console.log(fd);
            $("#add_building_btn").text('Adding...');
            $.ajax({
                url: '{{ route('building.store') }}',
                method: 'post',
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
                            'Building Added Successfully!',
                            'success'
                        );
                        fetchAllBuildings();
                    }
                    $("#add_building_btn").text('Add Building');
                    $("#add_building_form")[0].reset();
                    $("#addBuildingModal").modal('hide');
                }
            });
        });
    });
    </script>
    @endsection
