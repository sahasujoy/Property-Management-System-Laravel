<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Flat;
use App\Models\Registration;
use App\Models\Status;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //
    public function registrationView()
    {
        $customers = Customer::all();
        $flats = Flat::all();
        return view('registration.registrations', compact('customers', 'flats'));
    }

    public function storeRegistration(Request $req)
    {
    // print_r($_POST); // print js console.log
    // print_r($_FILES); // print js console.log

    $registrationData = [
        'file_no' => $req->file_no,
        'customer_id' => $req->customer_id,
        'flat_id' => $req->flat_id,
        'date' => $req->date,
        'sub_deed_no' => $req->sub_deed_no,
    ];

    Registration::create($registrationData);
    return response()->json([
        'status' => 200
    ]);
    }

//fetch all employee
public function fetchAllRegistrations()
{
    $registrations = Registration::all();
    // print_r($engs);
    // echo $engs;
    $output = '';
    if($registrations->count() > 0)
    {
        // text-center is cut from table class
        $output .= '<table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">File No.</th>
            <th scope="col">Customer ID</th>
            <th scope="col">Flat No.</th>
            <th scope="col">Flat Registration Date</th>
            <th scope="col">Flat Reg. Sub-Deed No.</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>';
        foreach($registrations as $registration)
        {
          $output .= '<tr>
          <td>' .$registration->id. '</td>
          <td>' .$registration->file_no. '</td>
          <td>' .$registration->customer_id.'</td>
          <td>' .$registration->flat_id. '</td>
          <td>' .$registration->date. '</td>
          <td>' .$registration->sub_deed_no. '</td>
          <td>
            <a href="#" id="' .$registration->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
            <a href="#" id="' .$registration->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
            <a href="/registration_details/'.$registration->id.' " id="' .$registration->id. '" class = "text-danger mx-1 displayIcon"><i class="bi-display h4"></i></a>
          </td>
        </tr>';
        }
        $output .= '</tbody>
        </table>';
        echo $output;
    }
    else
    {
        echo '<h1 class = "text-center text-secondary my-5">No record present in the database!</h1>';
    }
}

    public function registrationDetails($id)
    {
        $reg = Registration::find($id);
        $customer = Customer::where('id', $reg->customer_id)->first();
        $flat = Flat::where('id', $reg->flat_id)->first();
        return view('registration.details', compact('reg', 'customer', 'flat'));
    }

    public function statusView()
    {
        $registrations = Registration::all();
        return view('registration.statuses', compact('registrations'));
    }

    public function storeStatus(Request $req)
    {
    // print_r($_POST); // print js console.log
    // print_r($_FILES); // print js console.log

    $statusData = [
        'registration_id' => $req->registration_id,
        'booking_date' => $req->booking_date,
        'land_status' => $req->land_status,
        'flat_status' => $req->flat_status,
        'mutation_status' => $req->mutation_status,
        'poa_status' => $req->poa_status,
    ];

    Status::create($statusData);
    return response()->json([
        'status' => 200
    ]);
    }

//fetch all employee
public function fetchAllStatuses()
{
    $statuses = Status::all();
    // print_r($engs);
    // echo $engs;
    $output = '';
    if($statuses->count() > 0)
    {
        // text-center is cut from table class
        $output .= '<table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Customer\'s Booking Date</th>
            <th scope="col">Customer\'s Email</th>
            <th scope="col">Customer\'s Name</th>
            <th scope="col">Customer\'s ID</th>
            <th scope="col">Customer\'s Address</th>
            <th scope="col">Registration File No.</th>
            <th scope="col">Customer Land Registration Status</th>
            <th scope="col">Customer Flat Registration Status</th>
            <th scope="col">Customer Mutation Cost Status</th>
            <th scope="col">Customer Power of Attorney Cost Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>';
        foreach($statuses as $status)
        {
          $output .= '<tr>
          <td>' .$status->id. '</td>
          <td>' .$status->booking_date. '</td>
          <td>' .$status->registrations->customers->email. '</td>
          <td>' .$status->registrations->customers->name. '</td>
          <td>' .$status->registrations->customers->customer_id. '</td>
          <td>' .$status->registrations->customers->address. '</td>
          <td>' .$status->registrations->file_no. '</td>
          <td>' .$status->land_status.'</td>
          <td>' .$status->flat_status. '</td>
          <td>' .$status->mutation_status. '</td>
          <td>' .$status->poa_status. '</td>
          <td>
            <a href="#" id="' .$status->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
            <a href="#" id="' .$status->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
          </td>
        </tr>';
        }
        $output .= '</tbody>
        </table>';
        echo $output;
    }
    else
    {
        echo '<h1 class = "text-center text-secondary my-5">No record present in the database!</h1>';
    }
}

}
