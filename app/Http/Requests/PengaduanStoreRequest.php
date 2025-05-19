<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PengaduanStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation(): void
    {
        $this->merge(['user_id' => Auth::user()->id]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prihal' => ['required'],
            'jenis' => ['required'],
            'alamat' => ['required'],
            'opd' => ['required'],
            'tanggal' => ['required', 'date'],
            'uraian' => ['required'],
            'user_id' => ['nullable'],
            'file'  => ['required', 'max:5120', 'mimes:jpg,bmp,png,jpeg,pdf'],
        ];
    }
}
