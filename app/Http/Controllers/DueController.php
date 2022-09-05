<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\Request;

class DueController extends Controller
{
    //
    public function regDueView()
    {
        return view('due.regdues');
    }

    public function flatDueView()
    {
        return view('due.flatdues');
    }
    public function fetchAllRegDues()
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
                <th scope="col">Customer\'s ID</th>
                <th scope="col">Customer\'s Name</th>
                <th scope="col">File No.</th>
                <th scope="col">Land Registry Amount</th>
                <th scope="col">Payment Complete Amount</th>
                <th scope="col">Mutation Cost</th>
                <th scope="col">Payment Complete Amount</th>
                <th scope="col">Flat Registration Cost</th>
                <th scope="col">Payment Complete Amount</th>
                <th scope="col">Power of Attorney Cost</th>
                <th scope="col">Payment Complete Amount</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>';
            foreach($registrations as $reg)
            {
              $output .= '<tr>
              <td>' .$reg->id. '</td>
              <td>' .$reg->customers->customer_id. '</td>
              <td>' .$reg->customers->name. '</td>
              <td>' .$reg->file_no. '</td>
              <td>' .$reg->prices->land_reg_cost.'</td>
              <td>' .$reg->payments->land_reg_cost.'</td>
              <td>' .$reg->prices->mutation_cost.'</td>
              <td>' .$reg->payments->mutation_cost.'</td>
              <td>' .$reg->prices->flat_reg_cost.'</td>
              <td>' .$reg->payments->flat_reg_cost.'</td>
              <td>' .$reg->prices->poa_cost.'</td>
              <td>' .$reg->payments->poa_cost.'</td>
              <td>
                <a href="#" id="' .$reg->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
                <a href="#" id="' .$reg->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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

    public function fetchAllFlatDues()
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
                <th scope="col">Customer\'s ID</th>
                <th scope="col">Customer\'s Name</th>
                <th scope="col">File No.</th>
                <th scope="col">Booking Money</th>
                <th scope="col">Downpayment Amount</th>
                <th scope="col">Installment Payment Complete</th>
                <th scope="col">Installment Payment Due</th>
                <th scope="col">Other Payment Complete</th>
                <th scope="col">Other Payment Due</th>
                <th scope="col">Total Payable Amount</th>
                <th scope="col">Total Payment Complete Amount</th>
                <th scope="col">Total Payment Due Amount</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>';
            foreach($registrations as $reg)
            {
              $total_price = $reg->prices->flat_price + $reg->prices->utility_charge + $reg->prices->car_parking  + $reg->prices->additional_cost;
              $total_payment = $reg->payments->booking_money + $reg->payments->downpayment + $reg->payments->land_piling_money1 + $reg->payments->land_piling_money2 + $reg->payments->building_piling + $reg->payments->first_roof_cast + $reg->payments->top_roof_cast + $reg->payments->final_work_cost + $reg->payments->car_parking;
              $remaining_price = $total_price - $total_payment;
              $installment_profit = (5 * ($reg->prices->installments / 12) * $remaining_price) / 100;
              $total_inst_amount = $remaining_price + $installment_profit;
              $per_installment = ($total_inst_amount) / $reg->prices->installments;
              $inst_pay_complete = $per_installment * $reg->payments->installments;
              $inst_pay_due = $total_inst_amount - $inst_pay_complete;
              $other_pay_complete = $reg->payments->land_reg_cost + $reg->payments->mutation_cost + $reg->payments->flat_reg_cost + $reg->payments->poa_cost;
              $other_price = $reg->prices->land_reg_cost + $reg->prices->mutation_cost + $reg->prices->flat_reg_cost + $reg->prices->poa_cost;
              $other_pay_due = $other_price - $other_pay_complete;
              $total_payable = $total_price + $other_price + $installment_profit;
              $total_pay_complete = $total_payment + $inst_pay_complete + $other_pay_complete;
              $total_due = $total_payable - $total_pay_complete;
              $output .= '<tr>
              <td>' .$reg->id. '</td>
              <td>' .$reg->customers->customer_id. '</td>
              <td>' .$reg->customers->name. '</td>
              <td>' .$reg->file_no. '</td>
              <td>' .$reg->payments->booking_money.'</td>
              <td>' .$reg->payments->downpayment.'</td>
              <td>' .$inst_pay_complete.'</td>
              <td>' .$inst_pay_due.'</td>
              <td>' .$other_pay_complete.'</td>
              <td>' .$other_pay_due.'</td>
              <td>' .$total_payable.'</td>
              <td>' .$total_pay_complete.'</td>
              <td>' .$total_due.'</td>
              <td>
                <a href="#" id="' .$reg->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
                <a href="#" id="' .$reg->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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
