<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiftCampaign;
use App\Models\GiftItem;
use Carbon\Carbon;
use App\Http\Requests\StoreGiftCampaignRequest;
use App\Http\Resources\GiftCampaignResource;
use App\Http\Providers\Auth;
use Illuminate\Support\Arr;


class GiftCampaignController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('HR'), 403);
        return GiftCampaignResource::collection(GiftCampaign::with('campaignStatus', 'itemCarts', 'comments')->orderBy('dispatch_date')->get());
    }

    public function store(StoreGiftCampaignRequest $request) 
    {
        $attributes = $request->validated();
        $itemCarts = $this->mapGiftItems(array_column($attributes['item_carts'], 'value', 'id'));
        unset($attributes['item_carts']);
        $giftCampaign = GiftCampaign::create($attributes);
        $giftCampaign->itemCarts()->sync($itemCarts);
        return new GiftCampaignResource($giftCampaign);
    }
    
    public function show($id)
    {
        $giftCampaign = GiftCampaign::with('comments.user')->findOrfail($id);
        $giftCampaign->load('itemCarts');
        $giftItems = GiftItem::get()->map(function($itemCarts) use ($giftCampaign) {
            $itemCarts->value = data_get($giftCampaign->itemCarts->firstWhere('id', $itemCarts->id), 'pivot.amount') ?? null;
            return $itemCarts;
        });
        $giftItems = $giftItems->filter(function ($item) {
            return $item['value'] != null;
        });
        $giftItems = $giftItems->values();
        return[
            'giftCampaign' => $giftCampaign,
            'giftItems' => $giftItems,
        ];
    }

    public function update(StoreGiftCampaignRequest $request, $id)
    {
        $attributes = $request->validated();
        $itemCarts = $this->mapGiftItems(array_column($attributes['item_carts'], 'value', 'id'));
        print_r($itemCarts);    
        unset($attributes['item_carts']);
        $giftCampaign = GiftCampaign::findOrFail($id);
        $giftCampaign->update($attributes);         
        $giftCampaign->itemCarts()->sync($itemCarts);
    }
    
    public function destroy($id)
    {
        return GiftCampaign::find($id)->delete();
    }

    private function mapGiftItems($ItemCarts)
    {        
    return collect($ItemCarts)->map(function ($i) {
        return ['amount' => $i];
    });
    }

}
