@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Create Gift Item.</div>

            <div class="card-body">
                <form action="/giftbox/public/gift-items" method="post">
                    @csrf
                    <x-form.input name="name"/>
            
                    <x-form.input name="unit_price"/>
            
                    <x-form.input name="unit_owned"/>
                    
                    <x-submit-button>Create</x-submit-button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection