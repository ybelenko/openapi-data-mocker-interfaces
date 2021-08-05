<?php

/**
 * Openapi Data Mocker Interfaces
 * PHP version 7.3
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
use OpenAPIServer\Mock\Exceptions\OpenApiDataMockerException;

/**
 * OpenApiServerMockerInterface.
 * Useful for mock server implementation and for unit testing.
 */
interface OpenApiServerMockerInterface extends OpenApiDataMockerInterface
{
    /**
     * Sets base url for mocked requests.
     * Server Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#server-object
     *
     * @param string|null $url       A URL to the target host. This URL supports Server Variables and MAY be relative, to indicate that the host location is relative to the location where the OpenAPI document is being served.
     *                               Variable substitutions will be made when a variable is named in {brackets}.
     *                               When not specified global HTTP_HOST or SERVER_NAME will be used instead.
     *                               Field 'url' in Server Object.
     * @param array|null  $variables A map between a variable name and its value.
     *                               The value is used for substitution in the server's URL template.
     *                               Field 'variables' in Server Object.
     *
     * @throws OpenApiDataMockerException When invalid url or variables provided.
     *
     * @return void
     */
    public function setServer(
        ?string $url = null,
        ?array $variables = null
    ): void;

    /**
     * Mocks PSR-7 server request.
     * Path Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#paths-object
     * Path Item Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#path-item-object
     * Operation Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#operation-object
     *
     * @param string     $path        A relative path to an individual endpoint.
     *                                The field name MUST begin with a forward slash (/). The path is appended (no relative URL resolution) to the expanded URL from the Server Object's url field in order to construct the full URL. Path templating is allowed.
     *                                Field '/{path}' in Path Object.
     * @param string     $method      HTTP Method.
     *                                Specified as get|put|post|delete|options|head|path|trace field in Path Item Object.
     * @param array|null $parameters  A list of parameters that are applicable for this operation.
     *                                The list MUST NOT include duplicated parameters. A unique parameter is defined by a combination of a name and location.
     *                                The list can use the Reference Object to link to parameters that are defined at the OpenAPI Object's components/parameters.
     *                                Field 'parameters' in Operation Object.
     * @param array|null $requestBody The request body applicable for this operation.
     *                                The requestBody is only supported in HTTP methods where the HTTP 1.1 specification RFC7231 has explicitly defined semantics for request bodies.
     *                                In other cases where the HTTP spec is vague, requestBody SHALL be ignored by consumers.
     *                                Field 'requestBody' in Operation Object.
     * @param array|null $security    A declaration of which security mechanisms can be used for this operation.
     *                                The list of values includes alternative security requirement objects that can be used.
     *                                Only one of the security requirement objects need to be satisfied to authorize a request.
     *                                To make security optional, an empty security requirement ({}) can be included in the array.
     *                                This definition overrides any declared top-level security.
     *                                To remove a top-level security declaration, an empty array can be used.
     *                                Field 'security' in Operation Object.
     * @param array|null $callbacks   A map of possible out-of band callbacks related to the parent operation.
     *                                The key is a unique identifier for the Callback Object.
     *                                Each value in the map is a Callback Object that describes a request that may be initiated by the API provider and the expected responses.
     *                                Field 'callbacks' in Operation Object.
     *
     * @throws OpenApiDataMockerException When invalid arguments passed.
     *
     * @return ServerRequestInterface
     */
    public function mockRequest(
        string $path,
        string $method,
        ?array $parameters = null,
        ?array $requestBody = null,
        ?array $security = null,
        ?array $callbacks = null
    ): ServerRequestInterface;

    /**
     * Mocks PSR-7 server response.
     * Responses Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#responses-object
     * Response Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#response-object
     * HTTP Status Codes @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#http-status-codes
     * Header Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#header-object
     * Media Types @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#media-types
     * Media Type Object @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#media-type-object
     *
     * @param string      $httpStatusCode   HTTP Status Code.
     *                                      To define a range of response codes, this field MAY contain the uppercase wildcard character X.
     *                                      For example, 2XX represents all response codes between [200-299].
     *                                      Only the following range definitions are allowed: 1XX, 2XX, 3XX, 4XX, and 5XX.
     *                                      Field 'HTTP Status Codes' in Responses Object.
     * @param array|null  $headers          Maps a header name to its definition.
     *                                      RFC7230 states header names are case insensitive.
     *                                      If a response header is defined with the name "Content-Type", it SHALL be ignored.
     *                                      Field 'headers' in Response Object.
     * @param string|null $contentMediaType Media type or media type range.
     *                                      Field 'content' of Response Object.
     * @param array|null  $contentSchema    The schema defining the content of the response.
     *                                      Field 'schema' in Media Type Object.
     *
     * @throws OpenApiDataMockerException When invalid arguments passed or media type not supported.
     *
     * @return ResponseInterface
     */
    public function mockResponse(
        string $httpStatusCode = '200',
        ?array $headers = null,
        ?string $contentMediaType = null,
        ?array $contentSchema = null
    ): ResponseInterface;
}
