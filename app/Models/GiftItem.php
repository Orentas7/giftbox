<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GiftCampaign;

class GiftItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function itemCart()
    {
        return $this->belongsToMany(GiftCampaign::class, 'item_carts', 'gift_item_id', 'gift_campaign_id')->withPivot('amount');
    }
}
