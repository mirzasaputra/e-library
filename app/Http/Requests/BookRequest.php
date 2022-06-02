<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'genre_id' => 'required',
            'name' => 'required',
            'publication_year' => 'required',
            'author' => 'required',
            'file' => [
                $this->routeName == 'admin.books.store' ? 'required' : 'nullable',
                'mimes:jpg,jpeg,png,gif'
            ]
        ];
    }
}
