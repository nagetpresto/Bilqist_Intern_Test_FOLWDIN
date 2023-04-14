<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $employee = Employee::all();
        return new EmployeeResource(true, 'Data Employee !', $employee);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'employee_nim' => 'required|unique:employees,employee_nim',
            'employee_name' => 'required',
            'start_date' => 'required',
            'employee_gender' => 'required',
            'employee_address' => 'required',
            'employee_phone' => 'required',
        ]);
        if ($validator -> fails()){
            return response()->json($validator->errors(),422);
        }else{
            $employee = Employee::create([
                'employee_nim' => $request->employee_nim,
                'employee_name' => $request->employee_name,
                'start_date' => $request->start_date,
                'employee_gender' => $request->employee_gender,
                'employee_address' => $request->employee_address,
                'employee_phone' => $request->employee_phone,
            ]);

            return new EmployeeResource(true, 'Data Create Success !', $employee);
        }
    }

    /**
     * Display the specified resource.
     * 
     */
    public function show($employee_id)
    {
        $employee = Employee::find($employee_id);
        if($employee){
            return new EmployeeResource(true, 'Data Found !', $employee);
        }else{
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $employee_id)
    {
        $validator = Validator::make($request->all(),[
            'employee_name' => 'required',
            'start_date' => 'required',
            'employee_gender' => 'required',
            'employee_address' => 'required',
            'employee_phone' => 'required',
        ]);
        if ($validator -> fails()){
            return response()->json($validator->errors(),422);
        }else{
            $employee = Employee::find($employee_id);
            if($employee){
                $employee->employee_name = $request->employee_name;
                $employee->start_date = $request->start_date;
                $employee->employee_gender = $request->employee_gender;
                $employee->employee_address = $request->employee_address;
                $employee->employee_phone = $request->employee_phone;
                $employee->save();
                return new EmployeeResource(true, 'Data Update Success !', $employee);
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
    public function destroy(string $employee_id)
    {
        $employee = Employee::find($employee_id);
            if($employee){
                $employee->delete();

                return new EmployeeResource(true, 'Data delete Success !', $employee);
            }else{
                return response()->json([
                    'message' => 'Data not found !'
                ], 422);
            }
    }
}
