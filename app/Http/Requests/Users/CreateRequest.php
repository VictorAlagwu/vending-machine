<?php

namespace App\Http\Requests\Users;

use App\Domain\Dto\Request\User\CreateDto;
use App\Domain\Enums\UserRoles\UserRoles;
use App\Domain\Traits\CustomValidationResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
        return [
            'username' => 'required|string|between:2,100|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string',
            'deposit' => request()->has('role') && request()->get('role') === UserRoles::SELLER ? '' :
                ['nullable', 'integer', Rule::in([0, 5, 10, 20, 50, 100])],
            'role' => ['nullable',  Rule::in([UserRoles::SELLER, UserRoles::BUYER])]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'deposit.*' => 'The only valid deposit values allowed are 5, 10, 20, 50, 100 or 0',
            'body.required' => 'A message is required',
        ];
    }

    public function convertToDto(): CreateDto
    {
        return CreateDto::fromRequest($this);
    }
}
