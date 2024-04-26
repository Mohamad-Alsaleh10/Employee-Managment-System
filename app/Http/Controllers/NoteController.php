<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\NoteResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\EmployeeNoteRequest;
use App\Http\Requests\DepartmentNoteRequest;

class NoteController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $notes = Note::with('noteable')->get();
            return $this->customeResponse(NoteResource::collection($notes),"Done",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    public function storeEmployeeNote(EmployeeNoteRequest $request,Employee $employee)
    {
        try {
            $note = $employee->notes()->create([
                'note' =>$request->note,
            ]);
            return $this->customeResponse(new NoteResource($note), 'Note Created Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    
    public function storeDepartmentNote(DepartmentNoteRequest $request,Department $department)
    {
        try {
            $note = $department->notes()->create([
                'note' =>$request->note,
            ]);
            return $this->customeResponse(new NoteResource($note), 'Note Created Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        try {
            return $this->customeResponse(new NoteResource($note), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        try {
            $note->note = $request->input('note') ?? $note->note;
            $note->save();
            return $this->customeResponse(new NoteResource($note), 'note updated Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        try {
            $note->delete();
            return $this->customeResponse("", 'note deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }
}
