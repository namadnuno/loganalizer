<?php

namespace Loganalizer;

use Monolog\Logger;
use GuzzleHttp\RequestOptions;
use Monolog\Handler\AbstractProcessingHandler;
use Loganalizer\Utility\GuzzleClient as Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class LoganalizerHandler extends AbstractProcessingHandler
{
    private $client;

    private $api_url;

    private $api_key;

    /**
     * Loganalizer construct
     *
     * @param Logger $level
     * @param boolean $bubble
     */
    public function __construct(string $api_url, string $api_key, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->api_url = $api_url;

        $this->api_key = $api_key;

        $this->client = new Client(
            GuzzleAdapter::createWithConfig([
                RequestOptions::TIMEOUT => 1,
                RequestOptions::CONNECT_TIMEOUT => 1,
                RequestOptions::HTTP_ERRORS => false,
            ])
        );
    }

    /**
     * @param array $record
     * @return void
     */
    protected function write(array $record): void
    {
        $this->client->send(
            $this->api_url,
            array_merge(
                $record,
                ['key' => $this->api_key]
            )
        );
    }
}
