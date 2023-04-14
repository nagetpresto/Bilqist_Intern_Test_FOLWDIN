<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractsResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with('employee')->with('position')->get();
        return new ContractsResource(true, 'Data Contracts !', $contracts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'employee_id' => 'required|unique:contracts,employee_id',
            'positions_id' => 'required',
            'status' => 'required',
        ]);
        if ($validator -> fails()){
            return response()->json($validator->errors(),422);
        }else{
            $contracts = Contract::with('employee')->with('position')->create([
                'employee_id' => $request->employee_id,
                'positions_id' => $request->positions_id,
                'status' => $request->status,
            ]);

            return new ContractsResource(true, 'Data Create Success !', collect([$contracts]));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contracts = Contract::with('employee')->with('position')->find($id);
        if($contracts){
            return new ContractsResource(true, 'Data Found !', collect([$contracts]));
        }else{
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'employee_id' => '',
            'positions_id' => 'required',
            'status' => 'required',
        ]);
        if ($validator -> fails()){
            return response()->json($validator->errors(),422);
        }else{
            $contracts = Contract::with('employee')->with('position')->find($id);
            if($contracts){
                $contracts->positions_id = $request->positions_id;
                $contracts->status = $request->status;
                $contracts->save();
                return new ContractsResource(true, 'Data Found !', collect([$contracts]));
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
    public function destroy(string $id)
    {
        $contracts = Contract::with('employee')->with('position')->find($id);
        if($contracts){
            $contracts->delete();
            return new ContractsResource(true, 'Data delete Success !', collect([$contracts]));
        }else{
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }
}
