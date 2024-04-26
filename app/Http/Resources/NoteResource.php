<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $noteableEntity = $this->noteable;
        $noteableResource = $noteableEntity instanceof \App\Models\Employee
                            ? new EmployeeResource($noteableEntity)
                            : new DepartmentResource($noteableEntity);
        return [
            'note' => $this->note,
            'noteable' => [
                'type' => class_basename($this->noteable_type),
                'details' => $noteableResource,
            ]
        ];
    }

}
