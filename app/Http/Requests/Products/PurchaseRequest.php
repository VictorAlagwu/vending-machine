<?php

namespace App\Http\Requests\Products;

use App\Domain\Dto\Request\Product\PurchaseDto;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'product_id' => 'required|string|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ];
    }

    public function convertToDto(): PurchaseDto
    {
        return PurchaseDto::fromRequest($this);
    }
}
