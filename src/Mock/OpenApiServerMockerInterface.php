<?php

/**
 * Openapi Data Mocker Interfaces
 * PHP version 7.1
 *
 * @package OpenAPIServer\Mock
 * @link    https://github.com/ybelenko/openapi-data-mocker-interfaces
 * @author  Yuriy Belenko <yura-bely@mail.ru>
 * @license MIT
 */

declare(strict_types=1);

namespace OpenAPIServer\Mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use OpenAPIServer\Mock\OpenApiDataMockerInterface;

/**
 * OpenApiServerMockerInterface.
 * Useful for mock server implementation and for unit testing.
 */
interface OpenApiServerMockerInterface extends OpenApiDataMockerInterface
{
    /**
     * Mocks PSR-7 server request.
     *
     * @param array|object $requestSchema OAS 3.0 definition of request.
     *
     * @return ServerRequestInterface
     */
    public function mockRequest($requestSchema): ServerRequestInterface;

    /**
     * Mocks PSR-7 server response.
     *
     * @param array|object $responseSchema OAS 3.0 definition of response.
     *
     * @return ResponseInterface
     */
    public function mockResponse($responseSchema): ResponseInterface;
}
