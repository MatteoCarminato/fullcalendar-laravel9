<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start' => Carbon::parse($this->start)->format('Y-m-d\TH:i:s'),
            'end' => Carbon::parse($this->end)->format('Y-m-d\TH:i:s'),
            'resourceId' => $this->resourceId,
            'status' => $this->status,
            'color' => $this->color,
        ];
    }
}
