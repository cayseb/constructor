<?php

namespace App\Http\Controllers\Form;

use App\Models\Field;
use App\Models\Input;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as BaseRequest;
use Illuminate\Support\Str;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

//    protected function prepareForValidation(): void
//    {
//        $this->merge([
//            'user_code' => UserCode::getCode(),
//        ]);
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(BaseRequest $request): array
    {
        $typeRules = [];
//        dd($request->all());
        $data = $request->except('_token','form');
        foreach ($data as $key => $field) {
            $id = Str::of($key)->afterLast('/')->value();
            $field = Field::findOrFail($id);
            $type = $field->getBelongsModel();
            $typeRules = array_merge($typeRules, [$key => $field->input->required ? 'required' : "nullable"]);
        }
//        dd($typeRules);
        return [
            ...$typeRules
        ];
    }
}
