<?php

namespace App\Http\Requests;

use App\Exceptions\ApiFailedException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BannerRequest extends FormRequest
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
            'banner_name' => 'required|string ',
            'banner_description' => 'required',
            'banner_image' => 'required|mimes:png,jpg,jpeg',
            'active_status' => ''
        ];
    }
}
