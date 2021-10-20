<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGiftCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'item_carts'   => ['array'],
            'item_carts.*.value' => ['required', 'numeric', 'integer'],
            'item_carts.*.id' => ['required', 'numeric', 'integer'],
            'campaign_status_id' => ['required', Rule::exists('campaign_statuses', 'id')],
            'dispatch_date' => ['required' , 'date_format:Y-m-d', 'after:tomorrow'],
            'delivery_date' => ['required', 'date_format:Y-m-d', 'after:tomorrow'],
        ];
    }

    public function messages()
    {
    return [
        'item_carts.array' => 'Select Gift Items And Their Amounts',
        'item_carts.*.value.required' => 'Gift Item Amount Is Required',
        'item_carts.*.value.numeric' => 'Gift Item Amount Must Be A Number'

    ];
    }
}
