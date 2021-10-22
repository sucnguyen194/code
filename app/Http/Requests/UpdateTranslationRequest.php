<?php

namespace App\Http\Requests;

use App\Models\Translation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UpdateTranslationRequest extends FormRequest
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

        $rules = Validator::make(request()->translation,[
            '*.name' => 'required',
            '*.locale' => 'required',
            '*.slug' => 'required',
        ]);

        return  $rules->validate();

    }
}
