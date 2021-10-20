@extends('layouts.app')

@section('content')
<gift-item-index></gift-item-index>

{{-- <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Gift Items</div>
            <div>
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200"> 
                        @foreach ($giftItems as $giftItem)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">                                
                                <div class="text-sm font-medium text-gray-900">
                                {{ $giftItem->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">                                
                                <div class="text-sm font-medium text-gray-900">
                                {{ $giftItem->unit_price/100 }} EUR
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">                                
                                <div class="text-sm font-medium text-gray-900">
                                {{ $giftItem->unit_owned }}
                                </div>
                            </td>   
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <a href="/giftbox/public/gift-items/{{ $giftItem->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <form action="/giftbox/public/gift-items/{{$giftItem->id}}" method="post">
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
</div> --}}

@endsection