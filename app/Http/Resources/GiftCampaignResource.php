<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CampaignStatusResource;
use App\Http\Resources\SubscriberResource;
use App\Http\Resources\ItemCartResource;
use App\Http\Resources\CommentResource;



class GiftCampaignResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "campaign_status_id" => $this->campaign_status_id,
            "user_id" => $this->user_id,
            "dispatch_date" => $this->dispatch_date,
            "delivery_date" => $this->delivery_date,
            "campaign_status" => CampaignStatusResource::make($this->whenLoaded('campaignStatus')),
            "subscribers" => SubscriberResource::make($this->whenLoaded('subscribers')),
            "itemCarts" => ItemCartResource::make($this->whenLoaded('itemCarts')),
            "comments" => CommentResource::make($this->whenLoaded('comments')),
        ];
    }
}
