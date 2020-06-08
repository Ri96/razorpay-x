<?php
/**
 * *
 *  *  * Copyright (C) OPTIMO TECHNOLOGIES  - All Rights Reserved
 *  *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  *  * Proprietary and confidential
 *  *  * Written by Sathish Kumar(satz) <sathish.thi@gmail.com>ManiKandan<smanikandanit@gmail.com >
 *  *
 *
 */

namespace OptimoApps\RazorPayX;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use JsonMapper\JsonMapperInterface;
use OptimoApps\RazorPayX\Enum\RazorPayXAPI;
use OptimoApps\RazorPayX\Handler\JsonMapperFactory;
use Psr\Http\Message\StreamInterface;

/**
 * Class Http
 * @package OptimoApps\RazorPayX
 */
abstract class Http
{

    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var JsonMapperInterface
     */
    protected JsonMapperInterface $jsonMapper;

    /**
     * Http constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->jsonMapper = (new JsonMapperFactory())->bestFit();
    }

    /**
     * @param string $endPoint
     * @param array $queryParams
     * @return StreamInterface
     */
    protected function get(string $endPoint, array $queryParams = []): StreamInterface
    {
        return $this->client->get(RazorPayXAPI::PROD_API . $endPoint, [
            'query' => $queryParams,
            RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
            RequestOptions::AUTH => [config('razorpay-x.key_id'), config('razorpay-x.key_secret')],
        ])->getBody();
    }

    /**
     * @param string $endPoint
     * @param array $params
     * @return StreamInterface
     */
    protected function post(string $endPoint, array $params): StreamInterface
    {
        return $this->client->post(RazorPayXAPI::PROD_API . $endPoint, [
            RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
            RequestOptions::AUTH => [config('razorpay-x.key_id'), config('razorpay-x.key_secret')],
            RequestOptions::JSON => $params
        ])->getBody();
    }

    /**
     * @param string $endPoint
     * @param array $params
     * @return StreamInterface
     */
    protected function patch(string $endPoint, array $params): StreamInterface
    {
        return $this->client->patch(RazorPayXAPI::PROD_API . $endPoint, [
            RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
            RequestOptions::AUTH => [config('razorpay-x.key_id'), config('razorpay-x.key_secret')],
            RequestOptions::JSON => $params
        ])->getBody();
    }

}