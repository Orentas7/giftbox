@extends('layouts.app')

@section('content')
<enrolled-campaigns></enrolled-campaigns>
{{-- 
<div class="row justify-content-center">
    <div>
        <div class="card">
            <div class="card-header">Campaigns you have taken part in</div>
            <div>
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr>
                        <th class="px-4 py-2 whitespace-nowrap">Name</th>
                        <th class="px-4 py-2 whitespace-nowrap">Status</th>
                        <th class="px-4 py-2 whitespace-nowrap">Open The Box</th>
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
                              @if($giftCampaign->campaignStatus->id == 4)
                                <a class="text-gray-900" href="/giftbox/public/campaigns/{{ $giftCampaign->id }}">
                                  See This Box!
                                </a>
                              @else
                                Wait For Box Delivery  
                              @endif 
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
                        </tr>
                      @endforeach
                    </tbody>                        
                </table> 
            </div>
        </div>
    </div>
</div> --}}

@endsection