<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftCampaign;
use Carbon\Carbon;

class HomeController extends Controller
{
       

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.app');
    }

    // public function enrolledCampaigns()
    // {
    //     $userId = request()->user()->id;        
    //     $giftCampaigns = GiftCampaign::where('dispatch_date', '<', Carbon::today())->whereHas('subscribers', function ($q) use ($userId) {
    //         $q->where('user_id', $userId);
    //     })->get();
    //     return view('enrolledCampaigns', [
    //         'giftCampaigns' => $giftCampaigns,
    //     ]);
    // }

}
