<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ClientResource extends JsonResource
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
            "name" => ucfirst($this->name),
            "email" => $this->email,
            "slug"  => $this->url,
            "count_access" => $this->count_access,
            "date_birth" => Carbon::make($this->date_birth)->format('d/m/Y'),
            "date_created" => Carbon::make($this->created_at)->format('d/m/Y'),
        ];
    }
}
