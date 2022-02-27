<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarRequest extends FormRequest
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
            "id" => "required",
            "title" => "required",
            "description" =>"required",
            "color" => "required",
            "status" => "required",
            "start" => "required",
            "end" => "required",
            "resourceId" => "required"
        ];
    }
}
