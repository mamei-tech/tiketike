<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RaffleResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'progress' => $this->progress,
            'price' => $this->tickets_price != null?$this->tickets_price : 0,
            'location' => $this->getLocation->name,
            'location_flag' => asset('pics/countries/png100px/'.$this->getLocation->code.'.png'),
            'owner_full_name' => $this->getOwner->full_name,
            'link' => route('raffle.tickets.available',['raffleId' => $this->id]),
            'follow_link' => route('raffles.follow',['raffleId' => $this->id]),
            'share_modal' => '@include("partials.front_modals.share_modal",["raffle" => '.$this->id.'])'
        ];
    }
}
