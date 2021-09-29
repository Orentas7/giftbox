<?php

namespace App\Http\Controllers;

use App\Models\GiftItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class GiftItemController extends Controller
{
    public function index() 
    {
        return view('giftItems.index', [
            'giftItems' => GiftItem::all()
        ]);
    }

    public function create()
    {        
        return view('giftItems.create');
    }
    
    public function store()
    {    
        $attributes = $this->validateGiftItem();
        GiftItem::create($attributes);
        return redirect('/gift-items');
    }

    public function edit(GiftItem $giftItem) 
    {
        return view('giftItems.edit', ['giftItem' => $giftItem]);
    } 

    public function update(GiftItem $giftItem) 
    {
        $attributes = $this->validateGiftItem($giftItem);
        $attributes['unit_owned'] += $giftItem->unit_owned;
        $giftItem->update($attributes);
        return back()->with('success', 'Item Updated!');
    }

    public function destroy(GiftItem $giftItem)
    {
        $giftItem->delete();
        return back()->with('success', 'Item Deleted!');
    }

    protected function validateGiftItem(?GiftItem $giftItem = null): array
    {
        $giftItem ??= new GiftItem();
        $attributes = request()->validate([
            'name' => ['required', Rule::unique('gift_items', 'name')->ignore($giftItem->id)],
            'unit_price' => 'required',
            'unit_owned' => 'required',
        ]);
        return $attributes;
    }
}
