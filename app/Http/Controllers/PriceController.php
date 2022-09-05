<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Registration;
use Illuminate\Http\Request;

class PriceController extends Controller
{
        //
        public function regPriceView()
        {
            $registrations = Registration::all();
            return view('price.regprices', compact('registrations'));
        }

        public function flatPriceView()
        {
            $registrations = Registration::all();
            return view('price.flatprices', compact('registrations'));
        }

        public function storePrice(Request $req)
        {
        $priceData = [
            'registration_id' => $req->registration_id,
            'land_reg_cost' => $req->land_reg_cost,
            'mutation_cost' => $req->mutation_cost,
            'flat_reg_cost' => $req->flat_reg_cost,
            'poa_cost' => $req->poa_cost,
            'flat_price' => $req->flat_price,
            'utility_charge' => $req->utility_charge,
            'car_parking' => $req->car_parking,
            'additional_cost' => $req->additional_cost,
            'installments' => $req->installments,
        ];

        Price::create($priceData);
        return response()->json([
            'status' => 200
        ]);
        }

    //fetch all employee
    public function fetchAllRegPrices()
    {
        $regprices = Price::all();
        // print_r($engs);
        // echo $engs;
        $output = '';
        if($regprices->count() > 0)
        {
            // text-center is cut from table class
            $output .= '<table class="table table-dark table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">File No.</th>
                <th scope="col">Land Registry Amount</th>
                <th scope="col">Mutation Cost</th>
                <th scope="col">Flat Registration Cost</th>
                <th scope="col">Power of Attorney Cost</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>';
            foreach($regprices as $price)
            {
              $output .= '<tr>
              <td>' .$price->id. '</td>
              <td>' .$price->registrations->file_no. '</td>
              <td>' .$price->land_reg_cost.'</td>
              <td>' .$price->mutation_cost. '</td>
              <td>' .$price->flat_reg_cost. '</td>
              <td>' .$price->poa_cost. '</td>
              <td>
                <a href="#" id="' .$price->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
                <a href="#" id="' .$price->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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

    public function fetchAllFlatPrices()
    {
        $flatprices = Price::all();
        // print_r($engs);
        // echo $engs;
        $output = '';
        if($flatprices->count() > 0)
        {
            // text-center is cut from table class
            $output .= '<table class="table table-dark table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">File No.</th>
                <th scope="col">Flat Price</th>
                <th scope="col">Utility Charge</th>
                <th scope="col">Car Parking Price</th>
                <th scope="col">Addition Work Cost</th>
                <th scope="col">Number of Installments</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>';
            foreach($flatprices as $price)
            {
              $output .= '<tr>
              <td>' .$price->id. '</td>
              <td>' .$price->registrations->file_no. '</td>
              <td>' .$price->flat_price.'</td>
              <td>' .$price->utility_charge. '</td>
              <td>' .$price->car_parking. '</td>
              <td>' .$price->additional_cost. '</td>
              <td>' .$price->installments. '</td>
              <td>
                <a href="#" id="' .$price->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
                <a href="#" id="' .$price->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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
