<?php

namespace App\Http\Requests\Users;

use App\Domain\Dto\Request\User\DepositDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepositRequest extends FormRequest
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
            'amount' =>  ['required', 'integer', Rule::in([0, 5, 10, 20, 50, 100])],
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
            'amount.*' => 'The only valid amount values allowed are 5, 10, 20, 50, 100',
        ];
    }

    public function convertToDto(): DepositDto
    {
        return DepositDto::fromRequest($this);
    }

}
