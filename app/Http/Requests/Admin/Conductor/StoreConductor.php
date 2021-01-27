<?php

namespace App\Http\Requests\Admin\Conductor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreConductor extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.conductor.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
//            'terminal' => ['required'],
            'name' => ['required', 'string'],
            'username' => ['required', Rule::unique('conductors', 'username'), 'string'],
            'password' => ['required', 'confirmed', 'min:7', 'string'],
            
        ];
    }

    /**
    * Modify input data
    *
    * @return array
    */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }

    public function getTerminalId()
    {
        if ($this->has('terminal')) {
            return $this->get('terminal')['id'];
        }
        return null;
    }

}
