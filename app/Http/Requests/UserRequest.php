<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    private $routeName;

    public function __construct()
    {
        $this->routeName = request()->route()->getName();
    }

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
            'name' => 'required',
            'email' => [
                'required',
                'email',
                $this->routeName == 'admin.users.store' ? 'unique:users,email' : Rule::unique('users', 'email')->ignoreModel($this->user)
            ],
            'username' => [
                'required',
                $this->routeName == 'admin.users.store' ? 'unique:users,username' : Rule::unique('users', 'username')->ignoreModel($this->user)
            ],
            'password' => $this->routeName == 'admin.users.store' ? 'required' : 'nullable',
            'confirm_password' => [
                $this->routeName == 'admin.users.store' ? 'required' : 'nullable',
                'required_with:password',
                'same:password',
            ],
            'role' => 'required'
        ];
    }
}
