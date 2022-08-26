<?php

namespace Visualcrossing\Weather;

use Psr\Http\Message\ResponseInterface;

interface RequestInterface
{

    /**
     * @return RequestInterface
     */
    public function make(): RequestInterface;

    /**
     * @param string $uri
     * @return RequestInterface
     */
    public function to(string $uri): RequestInterface;

    /**
     * @param array $headers
     * @return RequestInterface
     */
    public function withHeaders(array $headers = []): RequestInterface;

    /**
     * @param array $options
     * @return RequestInterface
     */
    public function withOptions(array $options = []): RequestInterface;

    /**
     * @param array $options
     * @return RequestInterface
     */
    public function addOptions(array $options = []): RequestInterface;

    /**
     * @return array
     */
    public function get(): array;

    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @param string $method
     * @return ResponseInterface
     * @throws \InvalidArgumentException
     */

    public function addQuery(array $query =[]): RequestInterface;

    /**
     * @param string $method
     * @return ResponseInterface
     * @throws \InvalidArgumentException
     */

    /**
     * @return array
     */
    public function getQuery(): array;

    public function request(string $method): ResponseInterface;

}
