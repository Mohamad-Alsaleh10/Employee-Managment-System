<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departments = Department::with('employees')->get();
            return $this->customeResponse(DepartmentResource::collection($departments),"Done",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            $department = Department::create([
                'name' =>$request->name,
                'description' =>$request->description,
            ]);
            return $this->customeResponse(new DepartmentResource($department), 'department Created Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        try {
            $department->load('employees');
            return $this->customeResponse(new DepartmentResource($department), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        try {
            $department->name = $request->input('name') ?? $department->name;
            $department->description = $request->input('description') ?? $department->description;
            $department->save();
            return $this->customeResponse(new DepartmentResource($department), 'department updated Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return $this->customeResponse("", 'department deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
    public function restore(String $id)
    {
        try {
            $department = Department::withTrashed()->findOrFail($id);
            $department->restore();
            return $this->customeResponse(new DepartmentResource($department), 'department restored successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
    
    public function forceDelete(Department $department)
    {
        try {
            $department->forceDelete();
            return $this->customeResponse("", 'department force deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }


}
