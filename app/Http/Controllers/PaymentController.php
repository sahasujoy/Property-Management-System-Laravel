<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function regPaymentView()
        {
            $registrations = Registration::all();
            return view('payment.regpayments', compact('registrations'));
        }

        public function flatPaymentView()
        {
            $registrations = Registration::all();
            return view('payment.flatpayments', compact('registrations'));
        }

        public function storePayment(Request $req)
        {
        $paymentData = [
            'registration_id' => $req->registration_id,
            'land_reg_cost' => $req->land_reg_cost,
            'mutation_cost' => $req->mutation_cost,
            'flat_reg_cost' => $req->flat_reg_cost,
            'poa_cost' => $req->poa_cost,
            'booking_money' => $req->booking_money,
            'downpayment' => $req->downpayment,
            'land_piling_money1' => $req->land_piling_money1,
            'land_piling_money2' => $req->land_piling_money2,
            'building_piling' => $req->building_piling,
            'first_roof_cast' => $req->first_roof_cast,
            'top_roof_cast' => $req->top_roof_cast,
            'final_work_cost' => $req->final_work_cost,
            'car_parking' => $req->car_parking,
            'installments' => $req->installments,
        ];

        Payment::create($paymentData);
        return response()->json([
            'status' => 200
        ]);
        }

    //fetch all employee
    public function fetchAllRegPayments()
    {
        $regpayments = Payment::all();
        // print_r($engs);
        // echo $engs;
        $output = '';
        if($regpayments->count() > 0)
        {
            // text-center is cut from table class
            $output .= '<table class="table table-dark table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">File No.</th>
                <th scope="col">Land Registry Cost Payment</th>
                <th scope="col">Mutation Cost Payment</th>
                <th scope="col">Flat Registration Cost Payment</th>
                <th scope="col">Power of Attorney Cost Payment</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>';
            foreach($regpayments as $payment)
            {
              $output .= '<tr>
              <td>' .$payment->id. '</td>
              <td>' .$payment->registrations->file_no. '</td>
              <td>' .$payment->land_reg_cost.'</td>
              <td>' .$payment->mutation_cost. '</td>
              <td>' .$payment->flat_reg_cost. '</td>
              <td>' .$payment->poa_cost. '</td>
              <td>
                <a href="#" id="' .$payment->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
                <a href="#" id="' .$payment->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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

    public function fetchAllFlatPayments()
    {
        $flatpayments = Payment::all();
        // print_r($engs);
        // echo $engs;
        $output = '';
        if($flatpayments->count() > 0)
        {
            // text-center is cut from table class
            $output .= '<table class="table table-dark table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">File No.</th>
                <th scope="col">Booking Money</th>
                <th scope="col">Downpayment Amount</th>
                <th scope="col">Land Piling Money 1</th>
                <th scope="col">Land Piling Money 2</th>
                <th scope="col">Building Piling Amount</th>
                <th scope="col">First Roof Casting Amount</th>
                <th scope="col">Top Roof Casting Amount</th>
                <th scope="col">Final Work Amount</th>
                <th scope="col">Car Parking Cost</th>
                <th scope="col">Paid No. of Installments</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>';
            foreach($flatpayments as $payment)
            {
              $output .= '<tr>
              <td>' .$payment->id. '</td>
              <td>' .$payment->registrations->file_no. '</td>
              <td>' .$payment->booking_money.'</td>
              <td>' .$payment->downpayment. '</td>
              <td>' .$payment->land_piling_money1. '</td>
              <td>' .$payment->land_piling_money2. '</td>
              <td>' .$payment->building_piling. '</td>
              <td>' .$payment->first_roof_cast. '</td>
              <td>' .$payment->top_roof_cast. '</td>
              <td>' .$payment->final_work_cost. '</td>
              <td>' .$payment->car_parking. '</td>
              <td>' .$payment->installments. '</td>
              <td>
                <a href="#" id="' .$payment->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
                <a href="#" id="' .$payment->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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
