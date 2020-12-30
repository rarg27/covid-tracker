<?php

namespace App\Http\Requests\Admin\Driver;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreDriver extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.driver.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'terminal' => ['required']
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
        if ($this->has('terminal')){
            return $this->get('terminal')['id'];
        }
        return null;
    }
}
