<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignStatus;
use App\Http\Resources\CampaignStatusResource;

class CampaignStatusController extends Controller
{
    public function index() 
    {
        return CampaignStatusResource::collection(CampaignStatus::all());
    }
}
