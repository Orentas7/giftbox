<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GiftCampaign;

class CampaignStatus extends Model
{
    use HasFactory;
    
    public function giftCampaign()
    {
        return $this->hasMany(GiftCampaign::class);
    }
}
