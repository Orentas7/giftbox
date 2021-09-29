@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ $giftCampaign->name }}</div>
            <div class="card-body">                    
                <table class="min-w-full divide-y divide-gray-200">                    
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <th>Item</th>
                            <th>Amount</th>
                        </tr>
                        @foreach($giftCampaign->itemCarts as $giftItems)
                        <tr>
                            <td class="py-4 whitespace-nowrap">                                
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $giftItems->name }}
                                </div>
                            </td>
                            <td class="py-4 whitespace-nowrap">                                
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $giftItems->pivot->amount }}
                                </div>
                            </td>
                        </tr>                    
                    </tbody>
                </table>
                @endforeach 
                <section class="pt-20">
                    <div class="flex justify-end mb-2">
                    @auth
                    <form action="/giftbox/public/campaigns/{{ $giftCampaign->id }}/comment" method="post" class="bg-gray-100 p-3 rounded-xl w-2/3">
                        @csrf
                        <header>
                            <div class="flex items-center ">
                                <select name="star" class="p-2 border rounded-xl">
                                <option value="">Rate Us!</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Star</option>
                                <option value="3">3 Star</option>
                                <option value="4">4 Star</option>
                                <option value="5">5 Star</option>
                                </select>                                    
                            </div>
                            <h4>Post a comment!</h4>
                        </header>
                        <div>
                        <textarea name="body" id="" rows="5"
                            class="w-full"
                            placeholder="Post your comments here!">{{old('body')}}</textarea>                            
                        </div>
                        <x-form.error name="body"/>
                        <x-form.error name="star"/>
                        <x-submit-button>Post</x-submit-button>
                    </form>
                    @endauth
                    </div>
                    @foreach($giftCampaign->comments as $comment)
                        <x-campaign-comment :comment="$comment"/>
                    @endforeach                        
                </section>
            </div>
        </div>
    </div>
</div>

@endsection