<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Tag as ResourcesTag;


class Lesson extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'Auth'=> $this->user->name,
            'Title'=>$this->title,
            'Contnet'=>$this->body,
            'Tags'=>ResourcesTag::collection($this->tags),
        ];
    }
}
