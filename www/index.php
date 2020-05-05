<?php

set_time_limit(30);

require_once '../init.php';

use Converter\Base as Converter;

$data = [
    'firstName'   => 'Vasya',
    'lastName'    => 'Pupkin',
    'dateOfBirth' => '1984-07-31',
    'Salary'      => '1000',
    'creditScore' => 'good',
];

$curl = new Curl();

$converter = Converter::getConverter(Converter::FORMAT_XML);
$response = $curl->request($converter->getRequestData($data));
$result = $converter->parseResponse($response);
vprintf('XML<br/>status: %s<br/>data: %s<br/>error: %s<br/>', $result);

$converter = Converter::getConverter(Converter::FORMAT_JSON);
$response = $curl->request($converter->getRequestData($data));
$result = $converter->parseResponse($response);
vprintf('JSON<br/>status: %s<br/>data: %s<br/>error: %s<br/>', $result);
