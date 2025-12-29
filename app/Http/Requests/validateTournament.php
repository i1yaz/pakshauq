<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateTournament extends FormRequest
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
            'name' => 'required',
            'pigeons' => 'required|integer|min:0',
            'supporter' => 'required|integer|min:0',
            'days' => 'required|integer|min:1',
            'time' => 'required',
            'club' => 'required',
            'poster' => 'sometimes|file|image',
            'sort' => 'integer'
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $flyingDates = $this->get('date');
        $validator->after(function ($validator) use ($flyingDates) {
            if ($this->validateFlyingDates($flyingDates)) {
                $validator->errors()->add('field', 'Please fill all date fields!');
            }
        });
        $validator->after(function ($validator) use ($flyingDates) {
            if ($this->validateFlyingDatesAreOverlapping($flyingDates)) {
                $validator->errors()->add('field', 'Matching date selected!');
            }
        });
    }

    private function validateFlyingDates($flyingDates)
    {
        $flyingDates = $this->get('date');
        $isDateNull = in_array(null, $flyingDates, true);
        $isAllDateExist = (sizeof(array_filter($flyingDates)) == $this->get('days')) ? true : false;
        return ($isDateNull || !$isAllDateExist) ? true : false;
    }
    private function validateFlyingDatesAreOverlapping($flyingDates)
    {
        return !(collect($flyingDates)->count() == collect($flyingDates)->unique()->count());
    }
}
