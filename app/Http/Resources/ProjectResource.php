<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'employees' => EmployeeResource::collection($this->whenLoaded('employees'))
        ];
    }
}
