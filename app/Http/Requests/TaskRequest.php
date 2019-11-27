<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'parent_id' => 'sometimes|required|integer|exists:tasks,id',
            'user_id' => 'required|integer',
            'points' => 'required|integer|between:1,10',
            'is_done' => 'required|integer|between:0,1',
            'email' => 'required|email',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            /** get error messages */
            $messageBag = $validator->errors();
            $messages = $messageBag->messages();

            $errors = [];

            foreach ($messages as $key => $message) {
                $errors[$key] = implode(', ', $message);
            }

            throw new \Exception(implode(', ', $errors), 400);
        }
    }
}
