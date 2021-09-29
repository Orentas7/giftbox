@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div  class="col-md-6">
        <div class="card">
            <div class="card-header">Edit Gift</div>
                <div class="card-body">
                    <form action="/giftbox/public/gift-items/{{ $giftItem->id }}" method="post">
        
                        @csrf
                        @method('PATCH')
                        <x-form.input name="name" :value="old('name', $giftItem->name)"/>
                
                        <x-form.input name="unit_price" :value="old('unit_price', $giftItem->unit_price)"/>
                
                        <x-form.input name="unit_owned" :value="old('unit_owned', $giftItem->unit_owned)"/>
                        
                        <x-submit-button>Update</x-submit-button>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>

@endsection