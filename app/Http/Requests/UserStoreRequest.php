<?php

namespace App\Http\Requests;


class UserStoreRequest extends BaseFormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'password' => 'required'
        ];
    }

    public function  messages()
    {
      return [
          'email.required' => 'Email alanı gereklidier.',
          'name.required' => 'Email alanı gereklidier.',
          'first_name.required' => 'Ad alanı gereklidier.',
          'last_name.required' => 'Soyad alanı gereklidier.',
          'password.required' => 'Şifre alanı gereklidier.',
          'email.unique' => 'Bu email adresi ile daha önce kayıt olunmuş.'
      ];
    }


}
