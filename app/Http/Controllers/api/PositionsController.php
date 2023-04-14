<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionsResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Positions;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Positions::all();
        return new PositionsResource(true, 'Data Positions !', $positions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'positions_title' => 'required',
            'positions_division' => 'required'
        ]);
        if ($validator -> fails()){
            return response()->json($validator->errors(),422);
        }else{
            $positions = Positions::create([
                'positions_title' => $request->positions_title,
                'positions_division' => $request->positions_division,
            ]);

            return new PositionsResource(true, 'Data Create Success !', $positions);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $positions_id)
    {
        $positions = Employee::find($positions_id);
        if($positions){
            return new PositionsResource(true, 'Data Found !', $positions);
        }else{
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $positions_id)
    {
        $validator = Validator::make($request->all(),[
            'positions_title' => 'required',
            'positions_division' => 'required'
        ]);
        if ($validator -> fails()){
            return response()->json($validator->errors(),422);
        }else{
            $positions = Positions::find($positions_id);
            if($positions){
                $positions->positions_title = $request->positions_title;
                $positions->positions_division = $request->positions_division;
                $positions->save();
                return new PositionsResource(true, 'Data Update Success !', $positions);
            }else{
                return response()->json([
                    'message' => 'Data not found !'
                ], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $positions_id)
    {
        $positions = Positions::find($positions_id);
        if($positions){
            $positions->delete();

            return new PositionsResource(true, 'Data Found !', $positions);
        }else{
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }
}
