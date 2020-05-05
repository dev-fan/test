<?php

declare(strict_types=1);

namespace Converter;

class Xml extends Base
{

    public function getRequestData(array $data): string
    {
        $now = new \DateTime();
        $dob = new \DateTime($data['dateOfBirth']);
        $dateDiff = $now->diff($dob);
        $xml = simplexml_load_string('<userInfo version="1.6"></userInfo>');
        $xml->addChild('firstName', $data['firstName']);
        $xml->addChild('lastName', $data['lastName']);
        $xml->addChild('salary', (string) $data['Salary']);
        $xml->addChild('age', (string) $dateDiff->y);
        $xml->addChild('creditScore', (string) $this->convertCreditScore($data['creditScore']));
        return $request = $xml->asXML();
    }

    public function parseResponse(string $response): array
    {
        $xml = simplexml_load_string($response);
        return [
            'status' => strtolower((string) $xml->returnCodeDescription),
            'data'   => $xml->transactionId,
            'error'  => $xml->returnError,
        ];
    }

}
