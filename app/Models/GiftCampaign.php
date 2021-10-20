<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CampaignStatus;
use App\Models\GiftItem;
use App\Models\User;
use App\Models\Comment;

class GiftCampaign extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['campaignStatus'];

    public function campaignStatus()
    {
       return $this->belongsTo(CampaignStatus::class);
    }

    public function itemCarts()
    {
       return $this->belongsToMany(GiftItem::class, 'item_carts', 'gift_campaign_id', 'gift_item_id')->withPivot('amount');
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscribers', 'gift_campaign_id', 'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
