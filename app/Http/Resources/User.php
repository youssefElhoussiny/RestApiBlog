<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Lesson as ResourcesLesson;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'Full Name'=>$this->name,
            'E-Mail'=>$this->email,
            'Lessons'=> ResourcesLesson::collection($this->lessons),
        ];
    }
}
