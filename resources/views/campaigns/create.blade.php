@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Create Gift Campaign</div>
            <div class="card-body">
                <form action="/giftbox/public/campaigns" method="post">
                    @csrf
                    <x-form.input name="name"/>
            
                    <x-form.input name="dispatch_date" type="date"/>
            
                    <x-form.input name="delivery_date" type="date"/>

                    <div class="mb-6">
                        <x-form.lable name="campaign status"/>
                        <select class="p-2 border rounded" name="campaign_status_id" id="campaign_status_id">
                            <option value="">Select Campaign Status</option>
                            @foreach(\App\Models\CampaignStatus::all() as $campaign_status)                                    
                                <option value="{{ $campaign_status->id }}" 
                                    {{ old('campaign_status_id') == $campaign_status->id ? 'selected' : ''}}>
                                        {{ ucwords($campaign_status->status )}}</option>
                            @endforeach                    
                        </select>                
                        <x-form.error name="campaign_status_id"/>
                    </div>

                    <table>
                        @foreach($giftItems as $giftItem)
                            <tr x-data="{enabled: {{ $giftItem->value ? 'true' : 'false' }}, value: {{ $giftItem->value ?? 'null' }}}">
                                <td class="pr-2">
                                    <input x-model="enabled" x-on:change="value = null" type="checkbox">
                                </td>
                                <td class="pr-2" x-on:click="enabled = !enabled">{{ $giftItem->name }}</td>                                
                                <td class="pr-2">
                                    <input 
                                    x-model="value" :disabled="!enabled"
                                    name="itemCarts[{{ $giftItem->id }}]" 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Amount">
                                    <x-form.error name="itemCarts"/>
                                    <x-form.error name="itemCarts.*"/>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <x-submit-button>Add</x-submit-button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection