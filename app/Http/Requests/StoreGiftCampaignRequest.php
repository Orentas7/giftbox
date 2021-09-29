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
            'itemCarts'   => ['array'],
            'itemCarts.*' => ['integer'],
            'campaign_status_id' => ['required', Rule::exists('campaign_statuses', 'id')],
            'dispatch_date' => ['required' , 'date_format:Y-m-d', 'after:tomorrow'],
            'delivery_date' => ['required', 'date_format:Y-m-d', 'after:tomorrow'],
        ];
    }
}
