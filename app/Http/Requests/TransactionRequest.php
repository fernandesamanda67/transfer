<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\UserRepository;
use App\Rules\IsCommonUser;
use App\Rules\HasAmount;

class TransactionRequest extends FormRequest
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

        $userRepository = new UserRepository();

        return [
            'value' => ['bail', 'required','numeric','min:0.01'],
            'payer_id' => ['bail', 'required','exists:users,id', new IsCommonUser($userRepository), new HasAmount($userRepository, $this->input('payer_id'), $this->input('value'))],
            'payee_id' => ['bail', 'required','exists:users,id'],
        ];
    }

}
