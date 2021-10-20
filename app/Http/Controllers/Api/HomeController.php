<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiftCampaign;
use Carbon\Carbon;
use App\Http\Resources\GiftCampaignResource;


class HomeController extends Controller
{
    public function index()
    {
        return GiftCampaignResource::collection(GiftCampaign::where('dispatch_date', '>', Carbon::today())->with('subscribers')->get());
    }   
    
}
