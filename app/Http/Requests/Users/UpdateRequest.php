<?php

namespace App\Http\Requests\Users;

use App\Domain\Dto\Request\User\UpdateDto;
use App\Domain\Enums\UserRoles\UserRoles;
use App\Domain\Traits\CustomValidationResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'username' => 'nullable|string|between:2,100|unique:users',
            // 'password' => 'nullable|string|confirmed|min:8',
            // 'password_confirmation' => 'required_if:password,1|string',
            'deposit' => request()->user()->role === UserRoles::SELLER ? '' :  
                    ['nullable', 'integer', Rule::in([0, 5, 10, 20, 50, 100])],
        ];
    }

    public function convertToDto(): UpdateDto
    {
        return UpdateDto::fromRequest($this);
    }
}
