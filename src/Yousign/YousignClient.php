<?php

declare(strict_types=1);

namespace Yousign;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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
     * @var \GuzzleHttp\Client|null
     */
    private $client;

    /**
     * Prepare default configuration options for Guzzle client
     */
    public function __construct(string $token, bool $production = false)
    {
        $this->options = [
            'base_uri' => $production
                ? 'https://api.yousign.com'
                : 'https://staging-api.yousign.com',
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
     * HTTP PUT wrapper
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
        } catch (RequestException $exception) {
            $message = sprintf(
                "%s\n%s\n",
                $exception->getMessage(),
                Psr7\str($exception->getRequest())
            );
            if ($exception->hasResponse()) {
                $message .= "\n" . Psr7\str($exception->getResponse());
            }
        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        throw new Exception($message);
    }
}
