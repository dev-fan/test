<?php

declare(strict_types=1);

class Curl
{

    /**
     * По идее, если это curl, то формат запроса нужно требовать присылать в параметрах урла
     * Но для имитации определяем сами.
     */
    public function request(string $data): string
    {
        if (stripos($data, 'xml') === 2) {
            return $this->imitationXmlResponse();
        } elseif (stripos($data, '{') === 0) {
            return $this->imitationJsonResponse();
        } else {
            throw new Exception('Unknown request format');
        }
    }

    public function imitationXmlResponse(): string
    {
        $int = random_int(0, 90);
        if ($int < 30) {
            return '<?xml version="1.0" encoding="UTF-8"?>
                <userInfo version="1.6">
                    <returnCode>1</returnCode>
                    <returnCodeDescription>SUCCESS</returnCodeDescription>
                    <transactionId>AC158457A86E711D0000016AB036886A03E7</transactionId>
                </userInfo>';
        } elseif ($int < 60) {
            return '<?xml version="1.0" encoding="UTF-8"?>
                <userInfo version="1.6">
                    <returnCode>0</returnCode>
                    <returnCodeDescription>REJECT</returnCodeDescription>
                </userInfo>';
        } else {
            return '<?xml version="1.0" encoding="UTF-8"?>
                <userInfo version="1.6">
                    <returnCode>0</returnCode>
                    <returnCodeDescription>ERROR</returnCodeDescription>
                    <returnError>Lead not Found</returnError>
                </userInfo>';
        }
    }

    public function imitationJsonResponse(): string
    {
        $int = random_int(0, 90);
        if ($int < 30) {
            return json_encode(['SubmitDataResult' => 'success']);
        } elseif ($int < 60) {
            return json_encode(['SubmitDataResult' => 'reject']);
        } else {
            return json_encode([
                'SubmitDataResult' => 'error',
                'SubmitDataErrorMessage' => 'Lead not Found'
            ]);
        }
    }

}
