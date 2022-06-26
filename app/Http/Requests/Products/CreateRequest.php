<?php

namespace App\Http\Requests\Products;

use App\Domain\Dto\Request\Product\CreateDto;
use App\Rules\CheckIfMultipleOfFive;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|between:2,100',
            'amount_available' => 'required|integer|',
            'cost' => ['required', new CheckIfMultipleOfFive()]            
        ];
    }

    public function convertToDto(): CreateDto
    {
        return CreateDto::fromRequest($this);
    }
}
