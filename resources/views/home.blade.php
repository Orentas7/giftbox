@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div>
        <div class="card">
            <div class="card-header">Choose Campaign To Subscribe!</div>
            <div>
                <table class="min-w-full divide-y divide-gray-200">                    
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr>
                        <th class="px-4 py-2 whitespace-nowrap">Name</th>
                        <th class="px-4 py-2 whitespace-nowrap">Status</th>
                        <th class="px-4 py-2 whitespace-nowrap">Dispatch Date</th>
                        <th class="px-4 py-2 whitespace-nowrap">Delivery Date</th>
                      </tr> 
                      @foreach ($giftCampaigns as $giftCampaign)
                        <tr>
                          <td class="px-4 py-4 whitespace-nowrap">                                
                            <div class="text-sm font-medium text-gray-900">
                                {{ $giftCampaign->name }}
                            </div>
                          </td>                        
                          <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                              {{ $giftCampaign->campaignStatus->status }}
                            </div> 
                          </td>
                          <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                              {{ $giftCampaign->dispatch_date }}
                            </div> 
                          </td>
                          <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                              {{ $giftCampaign->delivery_date }}
                            </div> 
                          </td>                              
                          <td class="pr-4 text-center text-sm font-medium">
                              @foreach($giftCampaign->subscribers as $user)
                                @if (auth()->user()?->id === $user->pivot->user_id)
                                  <form action="/giftbox/public/campaigns/unsubscribe/{{$giftCampaign->id}}" method="post">
                                    @csrf
                                    <x-submit-button>Unsubscribe</x-submit-button>
                                  </form>
                                    @php
                                      $i = true
                                    @endphp 
                                @endif
                              @endforeach
                                @if(!isset($i))
                                    <form action="/giftbox/public/campaigns/subscribe/{{$giftCampaign->id}}" method="post">
                                      @csrf
                                      <x-submit-button>Subscribe</x-submit-button>
                                    </form>                                   
                                @endif
                                @php
                                unset($i)
                              @endphp 
                          </td>
                        </tr>
                      @endforeach
                    </tbody>                        
                </table> 
            </div>
        </div>
    </div>
</div>

@endsection