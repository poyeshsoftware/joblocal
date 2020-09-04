<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'is_complete' => $this->is_complete,
        ];
    }
}
