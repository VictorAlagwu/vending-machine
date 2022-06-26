<?php

namespace App\Http\Requests\Products;

use App\Domain\Dto\Request\Product\UpdateDto;
use App\Rules\CheckIfMultipleOfFive;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'nullable|string|between:2,100',
            'amount_available' => 'nullable|integer|',
            'cost' => ['nullable', new CheckIfMultipleOfFive()]            
        ];
    }

    public function convertToDto(): UpdateDto
    {
        return UpdateDto::fromRequest($this);
    }
}
