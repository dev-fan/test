<?php

declare(strict_types=1);

namespace Converter;

class Json extends Base
{

    public function getRequestData(array $data): string
    {
        $info = [
            'userInfo' => [
                'firstName'   => 'Vasya',
                'lastName'    => 'Pupkin',
                'dateOfBirth' => '1984-07-31',
                'Salary'      => '1000',
                'creditScore' => $this->convertCreditScore($data['creditScore']),
            ],
        ];
        return json_encode($info);
    }

    public function parseResponse(string $response): array
    {
        $json = json_decode($response);
        return [
            'status' => strtolower($json->SubmitDataResult),
            'data'   => null,
            'error'  => $json->SubmitDataErrorMessage ?? null,
        ];
    }

}
