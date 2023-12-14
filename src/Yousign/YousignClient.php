<?php

declare(strict_types=1);

namespace Yousign;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use Psr\Http\Message\MessageInterface;
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
final class YousignClient
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
     * @var Client|null
     */
    private $client;

    public const API_VERSION_2 = 'v2';
    public const API_VERSION_3 = 'v3';

    /**
     * Prepare default configuration options for Guzzle client
     */
    public function __construct(
        string $token,
        bool $production = false,
        string $version = self::API_VERSION_2
    ) {
        if ($version === 'v3') {
            $url = $production ? 'https://api.yousign.app/v3' : 'https://api-sandbox.yousign.app/v3';
        } else {
            $url = $production ? 'https://api.yousign.com' : 'https://staging-api.yousign.com';
        }

        $this->options = [
            'base_uri' => $url,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type'  => 'application/json',
            ],
            'connect_timeout' => 30,
            'cookies' => true,
        ];
    }

    /**
     * Set or override Guzzle client options
     *
     * @param  array $options
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
     */
    public function get(string $uri, array $params = []): ResponseInterface
    {
        return $this->send('get', $uri, $params);
    }

    /**
     * HTTP POST wrapper
     */
    public function post(string $uri, array $params): ResponseInterface
    {
        return $this->send('post', $uri, $params);
    }

    /**
     * HTTP PATCH wrapper
     */
    public function patch(string $uri, array $params): ResponseInterface
    {
        return $this->send('patch', $uri, $params);
    }

    /**
     * HTTP PUT wrapper
     */
    public function put(string $uri, array $params): ResponseInterface
    {
        return $this->send('put', $uri, $params);
    }

    /**
     * HTTP DELETE wrapper
     */
    public function delete(string $uri): ResponseInterface
    {
        return $this->send('delete', $uri);
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
        } catch (RequestException $exception) {
            $message = sprintf(
                "%s\n%s\n",
                $exception->getMessage(),
                Message::toString($exception->getRequest())
            );
            if ($exception->hasResponse()) {
                /** @var MessageInterface */
                $response = $exception->getResponse();
                $message .= "\n" . Message::toString($response);
            }
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }

        throw new \Exception($message);
    }
}
