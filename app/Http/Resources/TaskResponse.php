<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'parent_id' => $this->parent_id ?? null,
            'user_id' => (int) $this->user_id,
            'title' => (string) $this->title,
            'points' => (int) $this->points,
            'is_done' => (int) $this->is_done,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
