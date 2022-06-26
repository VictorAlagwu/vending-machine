<?php

namespace App\Http\Requests\Auth;

use App\Domain\Dto\Request\Auth\RegisterDto;
use App\Domain\Traits\CustomValidationResponse;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use CustomValidationResponse;
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
        return [
            'username' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string',
        ];
    }

    public function convertToDto(): RegisterDto
    {
        return RegisterDto::fromRequest($this);
    }
}
