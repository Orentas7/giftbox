<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiftItem;
use App\Http\Resources\GiftItemResource;
use App\Http\Requests\StoreGiftItemRequest;

class GiftItemController extends Controller
{
    public function index()
    {
        return GiftItemResource::collection(GiftItem::all());
    }
    
    public function store(StoreGiftItemRequest $request) {
        $giftItem = GiftItem::create($request->validated());
        return new GiftItemResource($giftItem);
    }

    public function show($id)
    {
        return GiftItem::findOrFail($id);
    }

    
    public function update(StoreGiftItemRequest $request, $id)
    {
        $attributes = $request->validated();
        $giftItem = GiftItem::findOrFail($id);
        $attributes['unit_owned'] += $giftItem->unit_owned;
        $giftItem->update($attributes);
        return new GiftItemResource($giftItem);
    }

    
    public function destroy($id)
    {
        GiftItem::find($id)->delete();
        return response()->noContent();
    }
    
}
