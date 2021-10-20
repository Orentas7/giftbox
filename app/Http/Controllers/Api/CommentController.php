<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CommentsResource;
use App\Models\Comments;
use App\Models\GiftCampaign;

class CommentController extends Controller
{
    public function store()
    {       
        request()->validate([
            'body' => 'required',
            'star' => 'required'
        ]);
        $giftCampaign = GiftCampaign::findOrFail(request('id'));
        $giftCampaign->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body'),
            'star' => request('star')
        ]);
    }
}
