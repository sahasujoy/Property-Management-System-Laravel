<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function customerView()
    {
    return view('customer.customers');
    }

    public function storeCustomer(Request $req)
    {
    // print_r($_POST); // print js console.log
    // print_r($_FILES); // print js console.log
    $file = $req->file('nid');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->storeAs('public/images', $filename);

    $customerData = [
        'customer_id' => $req->customer_id,
        'name' => $req->name,
        'phone' => $req->phone,
        'email' => $req->email,
        'address' => $req->address,
        'country' => $req->country,
        'nid' => $filename,
    ];

    Customer::create($customerData);
    return response()->json([
        'status' => 200
    ]);
    }

//fetch all employee
public function fetchAllCustomers()
{
    $customers = Customer::all();
    // print_r($engs);
    // echo $engs;
    $output = '';
    if($customers->count() > 0)
    {
        // text-center is cut from table class
        $output .= '<table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Customer ID</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Contact No.</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Country</th>
            <th scope="col">NID Image</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>';
        foreach($customers as $customer)
        {
          $output .= '<tr>
          <td>' .$customer->id. '</td>
          <td>' .$customer->customer_id. '</td>
          <td>' .$customer->name.'</td>
          <td>' .$customer->phone. '</td>
          <td>' .$customer->email. '</td>
          <td>' .$customer->address. '</td>
          <td>' .$customer->country. '</td>
          <td><img src="/storage/images/' .$customer->nid. '" width = "50px" class = "img-thumbnail rounded-circle"/></td>
          <td>
            <a href="#" id="' .$customer->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
            <a href="#" id="' .$customer->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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
