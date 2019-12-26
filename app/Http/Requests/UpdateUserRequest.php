<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::id() == $this->request->get('user_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:60', 'unique:users,username,' . Auth::id()],
            'twitter_username' => ['string', 'max:15', 'regex:/^[A-Za-z0-9_]{1,15}$/i'],
        ];
    }
}
