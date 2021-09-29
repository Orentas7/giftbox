<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftCampaign;
use App\Models\GiftItem;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreGiftCampaignRequest;
use PDF;


class GiftCampaignController extends Controller
{
    public function index()
    {
        return view('campaigns.index',[
            'giftCampaigns' => GiftCampaign::with('campaignStatus', 'itemCarts', 'comments')->orderBy('dispatch_date')->get(),
        ]);
    }

    public function create()
    {
        return view('campaigns.create', [
            'giftItems' => GiftItem::all(),
        ]);
    }

    public function store(StoreGiftCampaignRequest $request)
    {        
        $attributes = $request->validated();
        $itemCarts = $this->mapGiftItems($attributes['itemCarts']);
        unset($attributes['itemCarts']);
        $giftCampaign = GiftCampaign::create($attributes);
        $giftCampaign->itemCarts()->sync($itemCarts);
        return redirect('/campaigns');
    }

    public function show(GiftCampaign $giftCampaign)
    {
        return view('campaigns.show', [
            'giftCampaign' => GiftCampaign::with('itemCarts')->findOrFail($giftCampaign->id),
        ]);
    }

    public function edit(GiftCampaign $giftCampaign) 
    {
        $giftCampaign->load('itemCarts');
        $giftItems = GiftItem::get()->map(function($itemCarts) use ($giftCampaign) {
            $itemCarts->value = data_get($giftCampaign->itemCarts->firstWhere('id', $itemCarts->id), 'pivot.amount') ?? null;
            return $itemCarts;
        });
        return view('campaigns.edit', [
            'giftCampaign' => $giftCampaign,
            'giftItems' => $giftItems,
        ]);
    } 

    public function update(GiftCampaign $giftCampaign, StoreGiftCampaignRequest $request) 
    {
        $attributes = $request->validated();
        $itemCarts = $this->mapGiftItems($attributes['itemCarts']);      
        unset($attributes['itemCarts']);
        $giftCampaign->update($attributes);                
        $giftCampaign->itemCarts()->sync($itemCarts);
        return redirect('/campaigns')->with('success', 'Campaign Updated!');
    }

    public function destroy(GiftCampaign $giftCampaign)
    {
        $giftCampaign->delete();
        return back()->with('success', 'Campaign Deleted!');
    }
    
    private function mapGiftItems($ItemCarts)
    {
    return collect($ItemCarts)->map(function ($i) {
        return ['amount' => $i];
    });
    }
    
    public function subscribe(GiftCampaign $giftCampaign, Request $request)
    {   
        if (auth()->id() == null) {
            return back()->with('success', 'You Have To Register To Subscribe');
        }
        foreach($giftCampaign->itemCarts as $itemCart) {
            $giftItem = GiftItem::firstOrFail()->where('id', '=', $itemCart->id)->first();
            $giftItem->unit_owned -= $itemCart->pivot->amount;
            $giftItem->save();
        };
        $giftCampaign->subscribers()->attach(auth()->id());
        return back();
    }

    public function unsubscribe(GiftCampaign $giftCampaign, Request $request)
    {        
        $giftCampaign->subscribers()->detach(auth()->id());
        foreach($giftCampaign->itemCarts as $itemCart) {
            $giftItem = GiftItem::firstOrFail()->where('id', '=', $itemCart->id)->first();
            $giftItem->unit_owned += $itemCart->pivot->amount;
            $giftItem->save();
        };
        return back();
    }

    public function pdf()
    {
        $pdf = PDF::loadView('campaigns.pdf', ['giftCampaigns' => GiftCampaign::with(['subscribers'])->get()]);
        return $pdf->download('campaigns.pdf');
    }
}
