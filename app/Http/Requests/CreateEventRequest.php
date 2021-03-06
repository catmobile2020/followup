<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            //
            'title'=>'required|min:10',
            'body'=>'required',
            'photo'=>'sometimes | mimes:jpeg,jpg,png | max:1000',
            'location'=>'required',
            'event_date'=>'required'
        ];
    }
}
