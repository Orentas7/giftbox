<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftCampaign;

class CommentController extends Controller
{
    public function store(GiftCampaign $giftCampaign)
    {  
        request()->validate([
            'body' => 'required',
            'star' => 'required'
        ]);
        $giftCampaign->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body'),
            'star' => request('star')
        ]);
        return back();
    }
}
