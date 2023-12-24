<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'employee_id'=> 'required',
          'name'=> 'required',
          'email'=>'required|unique:users,email',
          'phone'=>'required|unique:users,phone',
          'address'=>'required',
          'pin_code'=>'required|min:6|max:6|unique:users,pin_code',
          'nrc_number'=>'required',
          'gender'=>'required',
          'department_id'=>'required',
          'birthday'=>'required',
          'join_date'=>'required',
          'password'=> 'required',
          'image'=>'required|mimes:png,jpg,jpeg,webp'
        ];
    }
}
