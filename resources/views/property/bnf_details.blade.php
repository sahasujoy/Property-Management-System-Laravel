@extends('master')
@section('content')
<header>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Building & Flat Details</span></li>
          </ol>
        </nav>
    </div>
</header>

<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h3 class="text-light">Building & Flat Details</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addFlatModal"><i
                class="bi-plus-circle me-2"></i>Add Building Information</button>
          </div>
          <div class="card-body" id="#">
            <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Building Name</th>
                    <th scope="col">Building Location</th>
                    <th scope="col">Road No.</th>
                    <th scope="col">Building Face Direction</th>
                    <th scope="col">Building Number</th>
                    <th scope="col">Total Number of Floors</th>
                    <th scope="col">Total Number of Flats</th>
                    <th scope="col">Work Start Date</th>
                    <th scope="col">Work Complete Date</th>
                    <th scope="col">Work Complete Extended Date</th>
                    <th scope="col">Number of Flat Sold</th>
                    <th scope="col">Number of Flat Unsold</th>
                    <th scope="col">Update Building Information</th>
                    <th scope="col">Add Flat</th>
                    <th scope="col">Action View</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($buildings as $building)
                        <tr>
                            <td>{{ ++$count }}</td>
                            <td>{{ $building->name }}</td>
                            <td>{{ $building->location }}</td>
                            <td>{{ $building->road_no }}</td>
                            <td>{{ $building->face_direction }}</td>
                            <td>{{ $building->no }}</td>
                            <td>{{ $building->floors }}</td>
                            <td>{{ $building->flats }} <br> <a href="{{ route('bnf.fbyb', ['id' => $building->id]) }}" class="btn btn-primary" role="button">details</a></td>
                            <td>{{ $building->start_date }}</td>
                            <td>{{ $building->complete_date }}</td>
                            <td>{{ $building->complete_extended_date }}</td>
                            <td>{{ $building->no_of_sold }}</td>
                            <td>{{ $building->no_of_unsold }}</td>
                            <td><a href="#" id="{{ $building->id }}" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editBuildingModal"><i class = "bi-pencil-square h4"></i></a></td>
                            <td><a href="#" id="#" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#addFlatModal-{{ $building->id }}"><i class = "bi bi-plus h3"></i></a></td>
                            <td><a href="{{ route('bnf.fbyb', ['id' => $building->id]) }}" id="#" class = "text-success mx-1"><i class = "bi bi-eye h4"></i></a></td>
                        </tr>
                            <div class="modal fade" id="addFlatModal-{{ $building->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                        <label for="">Building Name</label>
                                        <input type="text" value="{{ $building->name }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg">
                                            <label for="">Road No.</label>
                                            <input type="text" value="{{ $building->road_no }}">
                                        </div>
                                    <div class="col-lg">
                                        <label for="">Building Number</label>
                                        <input type="text" value="{{ $building->no }}">
                                    </div>
                                    <div class="col-lg">
                                        <label for="">Building Face Direction</label>
                                        <input type="text" value="{{ $building->face_direction }}">
                                    </div>
                                    <div class="col-lg">
                                        <label for="">Building Location</label>
                                        <input type="text" value="{{ $building->location }}">
                                    </div>
                                    </div>
                                    <br>
                                    <h6><u>Add Flat Details</u></h6>
                                    <input type="text" name="building_id" value="{{ $building->id }}" hidden>
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
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
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
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

//add flat ajax request
$(document).on('submit', '#add_flat_form', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            console.log(fd.get('building_id'));
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
                    }
                    $("#add_flat_btn").text('Add Flat');
                    $("#add_flat_form")[0].reset();
                    $("#addFlatModal-"+fd.get('building_id')).modal('hide');
                }
            });
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
                        location.reload();
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
</script>
@endsection


