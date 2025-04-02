<?php

namespace Unidays;

use GuzzleHttp\Client;

/**
 * UNiDAYS SDK - Tracking Client Helper Class.
 *
 * @category   SDK
 * @package    UNiDAYS
 * @subpackage Redemption Tracking Client
 * @copyright  Copyright (c) 2018 MyUNiDAYS Ltd.
 * @license    MIT License
 * @version    Release: 1.2
 * @link       http://www.myunidays.com
 */
class TrackingClient
{
    private $key;
    private $tracking;

    function __construct(DirectTrackingDetails $DirectTrackingDetails, $key, $test = null)
    {
        $this->key = $key;
        $this->tracking = new TrackingHelper($DirectTrackingDetails, $test);
    }

    /**
     * Sends a Server-to-Server Redemption Tracking Request
     *
     * @link http://phphttpclient.com/ Documentation for HTTP-Client library
     * @return \Httpful\Response Http Response object of the resulting call
     * @throws \Httpful\Exception\ConnectionErrorException Throws exception if a connection cannot be established
     */
    public function sendRequest()
    {
        $url = $this->tracking->create_server_url($this->key);
        $client = new Client();

        $response = $client->post($url, [
            'headers' => [
                'User-Agent' => 'unidays-php-client-library/1.2'
            ]
        ]);

        return $response->getBody()->getContents();
    }
}

