<?php
namespace Loganalizer\Utility;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;
use Loganalizer\Exceptions\TransferException;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Client;

/**
 * This is a class that wraps a Guzzle Client in order to send records to slack.
 *
 * @deprecated Use a PSR-18 client instead.
 */
class GuzzleClient implements ClientInterface
{
    /**
     * @var GuzzleClientInterface
     */
    private $client;

    /**
     * @param GuzzleClientInterface $client
     * @param String $api_url 
     * @param String $api_key 
     */
    public function __construct($client)
    {
        @trigger_error('Using the custom HTTP Client implementation is deprecated and will be removed on 2.x. Use a PSR-18 HTTP Client instead.', E_USER_DEPRECATED);
        $this->client = new Client();
    }
    /**
     * @param array $data
     * @throws TransferException
     * @return void
     */
    public function send(string $url, array $data): void
    {
        try {
            $this->client->post($url, [
                RequestOptions::JSON => $data
            ]);
        } catch (GuzzleException $e) {
            throw new TransferException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
