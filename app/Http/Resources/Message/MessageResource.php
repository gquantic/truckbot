<?php

namespace App\Http\Resources\Message;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message_id' => $this->message_id,
            'text' => $this->text,
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y H:i'),
            'type' => $this->type,
        ];
    }
}
