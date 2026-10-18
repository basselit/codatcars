<?php

namespace Codatsoft\CodatCars\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HTReqUserRemoveCar extends FormRequest
{
    public int $userCarId;

    public function rules(): array
    {
        return [
            'carId' => ['required', 'integer', 'min:1'],
        ];
    }

    protected function passedValidation(): void
    {
        $v = $this->validated();
        $this->userCarId = $v['carId'];

    }

}
