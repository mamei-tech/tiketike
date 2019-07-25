<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
        $medias = '';
        foreach ($this->getMedia('raffles') as $media)
        {
            $medias.= $media->getUrl('thumb').';';
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'progress' => round($this->progress),
            'owner_name' => $this->getOwner->name,
            'medias' => $medias,
            'price' => $this->tickets_price != null?$this->tickets_price : 0,
            'location' => $this->getLocation->name,
            'location_flag' => asset('pics/countries/png100px/'.$this->getLocation->code.'.png'),
            'owner_full_name' => $this->getOwner->full_name,
            'to_modal' => Auth::check()?'#'.$this->id.'-share_modal' : '#login',
            'link_to_raffle' => route('raffle.tickets.available',['raffleId' => $this->id]),
            'follow_link' => route('raffles.follow',['raffleId' => $this->id]),
            'share_modal' => '@include("partials.front_modals.share_modal",["raffle" => '.$this->id.'])'
        ];
    }
}
