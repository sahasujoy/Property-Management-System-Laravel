<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Flat;
use App\Models\Land;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //
    public function landView()
    {
        return view('property.lands');
    }

    public function storeLand(Request $req)
    {
        // print_r($_POST); // print js console.log
        // print_r($_FILES); // print js console.log
        $file = $req->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $filename);

        $landData = [
            'mouza_name' => $req->mname,
            'size' => $req->size,
            'kcs' => $req->kcs,
            'ksa' => $req->ksa,
            'krs' => $req->krs,
            'kbs' => $req->kbs,
            'dcs' => $req->dcs,
            'dsa' => $req->dsa,
            'drs' => $req->drs,
            'dbs' => $req->dbs,
            'address' => $req->address,
            'image' => $filename,
        ];

        Land::create($landData);
        return response()->json([
            'status' => 200
        ]);
    }

    //fetch all employee
    public function fetchAllLands()
    {
        $lands = Land::all();
        // print_r($engs);
        // echo $engs;
        $output = '';
        if($lands->count() > 0)
        {
            // text-center is cut from table class
            $output .= '<table class="table table-dark table-hover">
            <thead>
              <tr>
                <th scope="col" rowspan="2">#</th>
                <th scope="col" rowspan="2">Mouza Name</th>
                <th scope="col" rowspan="2">Land Size</th>
                <th scope="col" colspan="4">Khatiyan No.</th>
                <th scope="col" colspan="4">Daag No.</th>
                <th scope="col" rowspan="2">Address</th>
                <th scope="col" rowspan="2">Image</th>
                <th scope="col" rowspan="2">Actions</th>
              </tr>
              <tr>
                <th>CS</th>
                <th>SA</th>
                <th>RS</th>
                <th>BS</th>
                <th>CS</th>
                <th>SA</th>
                <th>RS</th>
                <th>BS</th>
              </tr>
            </thead>
            <tbody>';
            foreach($lands as $land)
            {
              $output .= '<tr>
              <td>' .$land->id. '</td>
              <td>' .$land->mouza_name.'</td>
              <td>' .$land->size. '</td>
              <td>' .$land->kcs. '</td>
              <td>' .$land->ksa. '</td>
              <td>' .$land->krs. '</td>
              <td>' .$land->kbs. '</td>
              <td>' .$land->dcs. '</td>
              <td>' .$land->dsa. '</td>
              <td>' .$land->drs. '</td>
              <td>' .$land->dbs. '</td>
              <td>' .$land->address. '</td>

              <td><img src="/storage/images/' .$land->image. '" width = "50px" class = "img-thumbnail rounded-circle"/></td>
              <td>
                <a href="#" id="' .$land->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
                <a href="#" id="' .$land->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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

//     public function edit(Request $req)
//     {
//         $id = $req->id;
//         $eng = Engineer::find($id);
//         return response()->json($eng);
//     }

//     //update engineer ajax request
//     public function update(Request $req)
//     {
//         $filename = '';
//         $eng = Engineer::find($req->eng_id);
//         if($req->hasFile('avatar'))
//         {
//             $file = $req->file('avatar');
//             $filename = time(). '.' .$file->getClientOriginalExtension();
//             $file->storeAs('public/images', $filename);
//             if($eng->avatar)
//             {
//                 Storage::delete('public/images', $eng->avatar);
//             }
//         }
//         else
//         {
//             $filename = $req->eng_avatar;
//         }
//         $engData = [
//             'first_name' => $req->fname,
//             'last_name' => $req->lname,
//             'email' => $req->email,
//             'post' => $req->post,
//             'phone' => $req->phone,
//             'avatar' => $filename,
//         ];
//         $eng->update($engData);
//         return response()->json([
//             'status' => 200
//         ]);
//     }

//     //delete engineer ajax request
//     public function delete(Request $req)
//     {
//         $id = $req->id;
//         $eng = Engineer::find($id);
//         if(Storage::delete('public/images' .$eng->avatar))
//         {
//             Engineer::destroy($id);
//         }
//     }

public function buildingView()
{
    $lands = Land::all();
    // dd($lands);
    return view('property.buildings', compact('lands'));
}

public function storeBuilding(Request $req)
{
    // print_r($_POST); // print js console.log
    // print_r($_FILES); // print js console.log
    // $file = $req->file('image');
    // $filename = time() . '.' . $file->getClientOriginalExtension();
    // $file->storeAs('public/images', $filename);

    $buildingData = [
        'land_id' => $req->land_id,
        'name' => $req->name,
        'road_no' => $req->road_no,
        'no' => $req->no,
        'face_direction' => $req->face_direction,
        'location' => $req->location,
        'floors' => $req->floors,
        'flats' => $req->flats,
        'start_date' => $req->start_date,
        'complete_date' => $req->complete_date,
        'complete_extended_date' => $req->complete_extended_date,
    ];

    Building::create($buildingData);
    return response()->json([
        'status' => 200
    ]);
}

//fetch all employee
public function fetchAllBuildings()
{
    $buildings = Building::all();
    // print_r($engs);
    // echo $engs;
    $output = '';
    if($buildings->count() > 0)
    {
        // text-center is cut from table class
        $output .= '<table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Land Mouza Name</th>
            <th scope="col">Building Name</th>
            <th scope="col">Road No.</th>
            <th scope="col">Building No.</th>
            <th scope="col">Building Face Direction</th>
            <th scope="col">Building Location</th>
            <th scope="col">Total Number of Floors</th>
            <th scope="col">Total Number of Flats</th>
            <th scope="col">Work Start Date</th>
            <th scope="col">Work Complete Date</th>
            <th scope="col">Work Complete Extended Date</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>';
        foreach($buildings as $building)
        {
          $output .= '<tr>
          <td>' .$building->id. '</td>
          <td>' .$building->lands->mouza_name. '</td>
          <td>' .$building->name. '</td>
          <td>' .$building->road_no. '</td>
          <td>' .$building->no.'</td>
          <td>' .$building->face_direction.'</td>
          <td>' .$building->location.'</td>
          <td>' .$building->floors. '</td>
          <td>' .$building->flats. '</td>
          <td>' .$building->start_date. '</td>
          <td>' .$building->complete_date. '</td>
          <td>' .$building->complete_extended_date. '</td>
          <td>
            <a href="#" id="' .$building->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editBuildingModal"><i class = "bi-pencil-square h4"></i></a>
            <a href="#" id="' .$building->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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

public function editBuilding(Request $req)
{
    $id = $req->id;
    $building = Building::find($id);
    return response()->json($building);
}

//update engineer ajax request
public function updateBuilding(Request $req)
{
    $building = Building::find($req->building_id);
    $buildingData = [
        'land_id' => $req->land_id,
        'name' => $req->name,
        'road_no' => $req->road_no,
        'no' => $req->no,
        'face_direction' => $req->face_direction,
        'location' => $req->location,
        'floors' => $req->floors,
        'flats' => $req->flats,
        'start_date' => $req->start_date,
        'complete_date' => $req->complete_date,
        'complete_extended_date' => $req->complete_extended_date,
    ];
    $building->update($buildingData);
    return response()->json([
        'status' => 200
    ]);
}

//delete engineer ajax request
public function deleteBuilding(Request $req)
{
    $id = $req->id;
    Building::destroy($id);
}


//--------------------------------------------- Flat Control --------------------------------------------------------

public function flatView()
{
    $buildings = Building::all();
    // dd($lands);
    return view('property.flats', compact('buildings'));
}

public function storeFlat(Request $req)
{
    // print_r($_POST); // print js console.log
    // print_r($_FILES); // print js console.log
    // $file = $req->file('image');
    // $filename = time() . '.' . $file->getClientOriginalExtension();
    // $file->storeAs('public/images', $filename);

    $flatData = [
        'building_id' => $req->building_id,
        'no' => $req->no,
        'floor' => $req->floor,
        'face_direction' => $req->face_direction,
        'size' => $req->size,
        'sell_status' => $req->sell_status,
    ];

    Flat::create($flatData);
    return response()->json([
        'status' => 200
    ]);
}

//fetch all employee
public function fetchAllFlats()
{
    $flats = Flat::all();
    // print_r($engs);
    // echo $engs;
    $output = '';
    if($flats->count() > 0)
    {
        // text-center is cut from table class
        $output .= '<table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Building No.</th>
            <th scope="col">Flat No.</th>
            <th scope="col">Flat Floor No.</th>
            <th scope="col">Flat Face Direction</th>
            <th scope="col">Flat Size</th>
            <th scope="col">Sell Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>';
        foreach($flats as $flat)
        {
          $output .= '<tr>
          <td>' .$flat->id. '</td>
          <td>' .$flat->buildings->no. '</td>
          <td>' .$flat->no.'</td>
          <td>' .$flat->floor. '</td>
          <td>' .$flat->face_direction. '</td>
          <td>' .$flat->size. '</td>
          <td>' .$flat->sell_status. '</td>
          <td>
            <a href="#" id="' .$flat->id. '" class = "text-success mx-1 editIcon" data-bs-toggle = "modal" data-bs-target = "#editEngineerModal"><i class = "bi-pencil-square h4"></i></a>
            <a href="#" id="' .$flat->id. '" class = "text-danger mx-1 deleteIcon"><i class = "bi-trash h4"></i></a>
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

    public function bnfDetails()
    {
        // $flat = Flat::where('building_id', 1)->where('sell_status', 'Unsold')->count();
        // dd($flat);
        $buildings = Building::withcount(['flats as no_of_sold'=>function($query)
        {
            $query->where('sell_status', 'Sold');
        }, 'flats as no_of_unsold' => function($query)
        {
            $query->where('sell_status', 'Unsold');
        }])->get();
        // dd($buildings);
        $count = 0;
        $lands = Land::all();
        return view('property.bnf_details', compact('buildings', 'count', 'lands'));
    }

    public function fbyb($id)
    {
        $building = Building::find($id);
        $flats = Flat::where('building_id', $id)->whereHas('registrations')->get(); //call those flats who have registration with a customer
        return view('property.fbyb', compact('building', 'flats'));
    }

    public function bnfFilter(Request $req)
    {
        if($req->sell_status == 'Sold')
        {
            $building = Building::find($req->building_id);
            $flats = Flat::where('building_id', $req->building_id)->where('sell_status', 'Sold')->get();
            return view('property.sold_filter', compact('building', 'flats'));
        }
        else if($req->sell_status == 'Unsold')
        {
            $building = Building::find($req->building_id);
            $flats = Flat::where('building_id', $req->building_id)->where('sell_status', 'Unsold')->get();
            return view('property.unsold_filter', compact('building', 'flats'));
        }
    }


}
