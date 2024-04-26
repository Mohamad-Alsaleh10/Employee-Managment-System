<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employees = Employee::all();
            return $this->customeResponse(EmployeeResource::collection($employees),"Done",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $employee = Employee::create([
                'first_name'    =>$request->first_name,
                'last_name'     =>$request->last_name,
                'email'         =>$request->email,
                'position'      =>$request->position,
                'department_id' =>$request->department_id,
            ]);
            return $this->customeResponse(new EmployeeResource($employee), 'employee Created Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        try {
            return $this->customeResponse(new EmployeeResource($employee), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->first_name = $request->input('first_name') ?? $employee->first_name;
            $employee->last_name = $request->input('last_name') ?? $employee->last_name;
            $employee->email = $request->input('email') ?? $employee->email;
            $employee->position = $request->input('position') ?? $employee->position;
            $employee->department_id = $request->input('department_id') ?? $employee->department_id;
            $employee->save();
            return $this->customeResponse(new EmployeeResource($employee), 'employee updated Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return $this->customeResponse("", 'employee deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
    public function restore(String $id)
    {
        try {
            $employee = Employee::withTrashed()->findOrFail($id);
            $employee->restore();
            return $this->customeResponse(new EmployeeResource($employee), 'employee restored successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
    
    public function forceDelete(Employee $employee)
    {
        try {
            $employee->forceDelete();
            return $this->customeResponse("", 'employee force deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

}
