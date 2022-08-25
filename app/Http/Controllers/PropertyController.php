<?php

namespace App\Http\Controllers;

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

              <td><img src="storage/images/' .$land->image. '" width = "50px" class = "img-thumbnail rounded-circle" </td>
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

}
