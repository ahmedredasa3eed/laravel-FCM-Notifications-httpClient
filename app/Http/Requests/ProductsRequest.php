<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'category_id' => 'required',
            'brand_id' => 'required',
            'tags_id' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'main_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
