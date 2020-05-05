<?php

declare(strict_types=1);

namespace Converter;

abstract class Base
{

    const FORMAT_XML = 'xml';
    const FORMAT_JSON = 'json';

    protected $creditScoreMap = [
        'good' => 700,
        'bad'  => 300,
    ];

    protected function convertCreditScore(string $creditScore): int
    {
        if (!isset($this->creditScoreMap[$creditScore])) {
            throw new Exception('Unknown credit score key "' . $creditScore . '"');
        }
        return $this->creditScoreMap[$creditScore];
    }

    abstract public function getRequestData(array $data): string;

    abstract public function parseResponse(string $data): array;

    public static function getConverter(string $format): self
    {
        switch ($format) {
            case self::FORMAT_XML:
                return new Xml();
            case self::FORMAT_JSON:
                return new Json();
            default:
                throw new Exception('Unknown format "' . $format . '"');
        }
    }

}
