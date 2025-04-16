<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'originalPrice' => 'required|numeric',
            'salePrice' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
        ];
    }
    public function messages(): array{
        return [
            'name.required'=> 'Tên sản phẩm không được để trống',
            'name.max'=> 'Tên sản phẩm không dài quá 255 ký tự',

            'originalPrice.required'=> 'Giá sản phẩm là bắt buộc',
            'originalPrice.numeric'=> 'Giá sản phẩm phải là số',
            'originalPrice.min'=> 'Giá sản phẩm phải lớn hơn hoặc bằng 0',

            'salePrice.required'=> 'Giá sản phẩm là bắt buộc',
            'salePrice.numeric'=> 'Giá sản phẩm phải là số',
            'salePrice.min'=> 'Giá sản phẩm phải lớn hơn hoặc bằng 0',

            'image.image' => 'Tệp tải lên phải là hình ảnh',
            'image.max'=> 'Ảnh không được lớn hơn 2MB',

            'category_id.required' => 'Loại sản phẩm phải bắt buộc',

            'quantity.required'=> 'Số lương là bắt buộc',
            'quantity.integer'=> 'Số lượng phải là só nguyên',
            'quantity.min'=> 'Số lượng không được âm',
        ];
    }
}
