<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndustryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('industry');
        $industryCodeRule = $id ? "unique:industries,industry_code,{$id},id" : 'unique:industries';
        $industryNameRule = $id ? "unique:industries,industry_name,{$id},id" : 'unique:industries';

        return [
            'industry_code' => "required|{$industryCodeRule}|max:10",
            'industry_name' => "required|string|max:255|{$industryNameRule}",
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'industry_code.required' => 'Vui lòng nhập mã ngành.',
            'industry_code.unique' => 'Mã ngành đã tồn tại. Hãy nhập mã khác.',
            'industry_code.max' => 'Mã ngành không được dài hơn :max ký tự.',
            'industry_name.required' => 'Vui lòng nhập tên ngành.',
            'industry_name.unique' => 'Tên ngành đã tồn tại. Hãy nhập tên khác.',
            'industry_name.max' => 'Tên ngành không được dài hơn :max ký tự.',
        ];
    }
}
