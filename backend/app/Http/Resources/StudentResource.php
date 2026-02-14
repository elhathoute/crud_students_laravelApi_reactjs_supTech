<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gender' => $this->gender ? strtoupper(mb_substr((string) $this->gender, 0, 1)) : null,
            'address' => $this->address,
            'birthDate' => $this->birthDate,
            'bacGrade' => $this->bacGrade,
            'photo' => $this->image ?: 'images/no-photo.jpg',
            'idBranch' => $this->idBranch,
            'branch' => $this->branch?->name
        ];
    }
}
