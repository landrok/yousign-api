<?php

namespace Yousign;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Psr\Http\Message\ResponseInterface;

/*
 * Low-level HTTP client
 *
 * Usage
 * --------
 *
 * - Get all users
 *
 * use Yousign\YousignClient;
 *
 * $yousign = new YousignClient('{token}', $production = false);
 * echo $yousign->get('/users')->getBody(); // JSON response
 */
class YousignClient
{
    /**
     * Client options
     *
     * @var array
     */
    public $options = [];

    /**
     * Authenticated HTTP client for Yousign API
     *
     * @var null|\GuzzleHttp\Client
     */
    private $client;

    /**
     * Prepare default configuration options for Guzzle client
     */
    public function __construct(string $token, bool $production = false)
    {
        $this->options = [
            'base_uri'        => $production
                ? "https://api.yousign.com"
                : "https://staging-api.yousign.com",
            'headers'         => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type'  => 'application/json',
            ],
            'connect_timeout' => 30,
            'cookies'         => true,
        ];
    }

    /**
     * Set or override Guzzle client options
     *
     * @param  array $options
     * @return self
     */
    public function setOptions(array $options): self
    {
        $this->options = array_merge(
            $this->options,
            $options
        );

        return $this;
    }

    /**
     * Authenticated HTTP client for Yousign API
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient(): Client
    {
        if (is_null($this->client)) {
            $this->client = new Client($this->options);
        }

        return $this->client;
    }

    /**
     * HTTP GET wrapper
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $uri, array $params = []): ResponseInterface
    {
        return $this->send('get', $uri, $params);
    }

    /**
     * HTTP POST wrapper
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $uri, array $params): ResponseInterface
    {
        return $this->send('post', $uri, $params);
    }

    /**
     * HTTP PUT wrapper
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function put(string $uri, array $params): ResponseInterface
    {
        return $this->send('put', $uri, $params);
    }

    /**
     * Send HTTP request
     *
     * @throws \Exception when an HTTP error occured
     */
    public function send(string $method, string $uri, array $params = []): ResponseInterface
    {
        try {
            return $this->getClient()->$method($uri, $params);
        } catch (RequestException $e) {
            $message = sprintf(
                "%s\n%s\n",
                $e->getMessage(),
                Psr7\str($e->getRequest())
            );
            if ($e->hasResponse()) {
                $message .= "\n" . Psr7\str($e->getResponse());
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        throw new Exception($message);
    }
}
