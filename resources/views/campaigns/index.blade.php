@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div>
        <div class="card">
            <div class="card-header ">Gift Campaigns
              @foreach($giftCampaigns as $giftCampaign)
                  <a href="/giftbox/public/campaigns/{{ $giftCampaign->id }}}/pdf">Gift campaign’s users PDF</a>
              @break
              @endforeach
            </div>
            <div>                    
                <table class="min-w-full divide-y divide-gray-200">                  
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr>
                        <th class="px-6 py-2 whitespace-nowrap">Name</th>
                        <th class="px-6 py-2 whitespace-nowrap">Status</th>
                        <th class="px-6 py-2 whitespace-nowrap">Rating</th>
                        <th class="px-6 py-2 whitespace-nowrap">Dispatch Date</th>
                        <th class="px-6 py-2 whitespace-nowrap">Delivery Date</th>
                        <th class="px-6 py-2 whitespace-nowrap"></th>
                      </tr>
                      @foreach ($giftCampaigns as $giftCampaign)
                        <tr>
                          <td class="px-6 py-4  whitespace-nowrap">                                
                            <div class="text-sm font-medium text-gray-900">
                              <a href="/giftbox/public/campaigns/{{ $giftCampaign->id }}/edit" class="text-blue-500 hover:text-blue-600">{{ $giftCampaign->name }}</a>
                            </div>
                          </td>
                          <td class="px-6 py-4  whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                              {{ $giftCampaign->campaignStatus->status }}
                            </div> 
                          </td>
                          <td class="px-6 py-4  whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                              @php
                                $totalStar=0;
                                foreach($giftCampaign->comments as $comment){
                                  $totalStar += $comment->star;
                                }
                              @endphp
                              @if($totalStar > 0)
                                {{ $totalStar/count($giftCampaign->comments) }} Stars
                              @else
                              No Data
                              @endif
                            </div> 
                          </td>
                          <td class="px-6 py-4  whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                              {{ $giftCampaign->dispatch_date }}
                            </div> 
                          </td>
                          <td class="px-6 py-4  whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                              {{ $giftCampaign->delivery_date }}
                            </div> 
                          </td>
                          <td class="px-6 py-4 text-right text-sm font-medium  whitespace-nowrap">
                            <form action="/giftbox/public/campaigns/{{$giftCampaign->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs text-gray-400">Delete</button>
                            </form>
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
{{-- 
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

{{ __('You are logged in!') }} --}}