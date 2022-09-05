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


<div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="card mb-3">
        <div class="card-header"><strong>Flat Registration Details of File No. {{ $reg->file_no }}</strong></div>
        <div class="card-body">
          <h2>Land Details</h2>
          <p>Mouza Name : {{ $flat->buildings->lands->mouza_name }}</p>
          <p>Land Size : {{ $flat->buildings->lands->size }}</p>
          <p><b>Khatiyan No :</b></p>
          <p>CS : {{ $flat->buildings->lands->kcs }}</p>
          <p>SA : {{ $flat->buildings->lands->ksa }}</p>
          <p>RS : {{ $flat->buildings->lands->krs }}</p>
          <p>BS : {{ $flat->buildings->lands->kbs }}</p>
          <p><b>Daag No :</b></p>
          <p>CS : {{ $flat->buildings->lands->dcs }}</p>
          <p>SA : {{ $flat->buildings->lands->dsa }}</p>
          <p>RS : {{ $flat->buildings->lands->drs }}</p>
          <p>BS : {{ $flat->buildings->lands->dbs }}</p>
          <p>Address : {{ $flat->buildings->lands->address }}</p>
          <br>
          <h2>Building Details</h2>
          <p>Building No. : {{ $flat->buildings->no }}</p>
          <p>Building Name : {{ $flat->buildings->name }}</p>
          <p>Building Size : {{ $flat->buildings->size }}</p>
          <p>Total Floors : {{ $flat->buildings->floor }}</p>
          <p>Total Flats : {{ $flat->buildings->flat }}</p>
          <br>
          <h2>Flat Details</h2>
          <p>Flat No. : {{ $flat->no }}</p>
          <p>Flat Name : {{ $flat->name }}</p>
          <p>Flat Size : {{ $flat->size }}</p>
          <p>Floor No.: {{ $flat->floor }}</p>
          <br>
          <h2>Flat Registration Details</h2>
          <p>Registration File No. : {{ $reg->file_no }}</p>
          <p>Registration Sub-Deed No. : {{ $reg->sub_deed_no }}</p>
          <p>Registration Date : {{ $reg->date }}</p>
      </div>
    </div>
  </div>
@endsection




