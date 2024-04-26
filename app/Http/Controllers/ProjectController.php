<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProjectRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $projects = Project::with('employees')->get();
            return $this->customeResponse(ProjectResource::collection($projects),"Done",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try {
            $project = Project::create([
                'name' =>$request->name,
            ]);
            if ($request->has('employee_id')) {
                $project->employees()->attach($request->input('employee_id'));
            }
            return $this->customeResponse(new ProjectResource($project), 'project Created Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {
            $project->load('employees');
            return $this->customeResponse(new ProjectResource($project), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        try {
            $project->name = $request->input('name') ?? $project->name;
            $project->save();
            if ($request->has('employee_id')) {
                $project->employees()->sync($request->input('employee_id'));
            }
            return $this->customeResponse(new ProjectResource($project), 'project updated Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->employees()->detach();
            $project->delete();
            return $this->customeResponse("", 'department deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
}
