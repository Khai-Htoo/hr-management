<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
        $id = $this->route('user');
        return [
            'employee_id' => 'required|unique:users,employee_id,'.$id,
            'name' => 'required' ,
            'email' => 'required|unique:users,email,'.$id ,
            'phone' => 'required|unique:users,phone,'.$id,
            'pin_code'=> 'required|unique:users,pin_code,'.$id,
            'address' => 'required',
            'nrc_number' => 'required',
            'gender' => 'required',
            'department_id' => 'required',
            'birthday' => 'required',
            'join_date' => 'required',
        ];
    }
}
