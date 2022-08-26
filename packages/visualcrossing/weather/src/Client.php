<?php

namespace Visualcrossing\Weather;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psy\Util\Json;

class Client implements RequestInterface
{

    /** @var string */
    private $baseUri;

    /** @var string */
    private $apiKey;

    /** @var GuzzleClient */
    protected GuzzleClient $client;

    /** @var string */
    protected string $uri = '';

    /** @var mixed */
    protected $body = [];

    /** @var array */
    protected array $headers = [];

    /** @var array */
    protected array $options = [];

    /** @var array */
    protected array $query = [];

    /** @var string */
    protected string $format = 'json';

    /**
     * Client constructor.
     */

    public function __construct()
    {

        $this->client = new GuzzleClient();
        $this->baseUri = Config('weather.baseUrl');
        $this->apiKey = Config('weather.apiKey');
    }

    /**
     * Create a new Guzzle Client specifying the Base URI.
     *
     * @param string $base_uri
     * @return RequestInterface
     */

    public function make(): RequestInterface
    {
        $this->client = new GuzzleClient(
            ['base_uri' => $this->baseUri]
        );

        return $this;
    }

    /**
     * Specify the URI for the Request.
     *
     * @param string $uri
     * @return RequestInterface
     */
    public function to(string $uri): RequestInterface
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Specify the payload.
     *
     * @param mixed $body
     * @param array $headers
     * @param array $options
     * @return RequestInterface
     */
    public function with($body = [], array $headers = [], array $options = []): RequestInterface
    {
        $this->body = $body;
        $this->headers = $headers;
        $this->options = $options;

        return $this;
    }

    /**
     * Specify the headers for the request.
     *
     * @param array $headers
     * @return RequestInterface
     */
    public function withHeaders(array $headers = []): RequestInterface
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Specify the options for the request.
     *
     * @param array $options
     * @return RequestInterface
     */
    public function withOptions(array $options = []): RequestInterface
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Append to existing options.
     *
     * @param array $options
     * @return RequestInterface
     */
    public function addOptions(array $options = []): RequestInterface
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * Get existing options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function addQuery(array $query = []): RequestInterface
    {
       $this->query = array_merge($this->query, $query);
       return $this;

    }

    /**
     * Get existing options.
     *
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * Get result by client.
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(): array
    {
        return $this->makeRequest();
    }

    /**
     * @param string $method
     * @return ResponseInterface
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method): ResponseInterface
    {
        if (!in_array(strtolower($method), ['get', 'post', 'put', 'patch', 'delete'])):
            throw new \InvalidArgumentException('Methods only GET, POST, PUT, PATCH or DELETE');
        endif;

        return $this->makeRequest($method);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function makeRequest(string $method = 'GET')
    {



        $requestParameters = [
            $this->format => $this->body,
            'headers' => $this->headers,
            'query' =>
                [
                    'key'=> $this->apiKey,
                    'unitGroup'=>'metric',

                    'contentType'=>'json'] + $this->query
        ];


        if ($this->options !== null) :
            $requestParameters = array_merge($requestParameters, $this->options);
        endif;


        $request = $this->client->request($method, $this->baseUri.'/'.$this->uri,$requestParameters);

        return json_decode($request->getBody()->getContents(), true);

    }

}
