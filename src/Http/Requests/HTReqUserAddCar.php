<?php

namespace Codatsoft\CodatCars\Http\Requests;

use Codatsoft\CodatCars\DBModels\Car;
use Codatsoft\CodatCars\DBModels\Color;
use Codatsoft\CodatCars\Models\DBMapped\CUserCar;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HTReqUserAddCar extends FormRequest
{
    public CUserCar $userCar;

    public function rules(): array
    {
        return [
            // By model, not table name: the catalogue may live in a shared schema (codatcars.schema).
            'carId' => ['required', 'integer', Rule::exists(Car::class, 'id')],
            'carColorId' => ['required', 'integer', Rule::exists(Color::class, 'id')],
            'plateNo' => ['required', 'digits_between:4,8'],
        ];
    }

    protected function passedValidation(): void
    {
        $v = $this->validated();
        $this->userCar = new CUserCar();

        $this->userCar->userId = $this->user()->id;
        $this->userCar->carId = $v['carId'];
        $this->userCar->carColorId = $v['carColorId'];
        $this->userCar->plateNo = $v['plateNo'];

    }

}
