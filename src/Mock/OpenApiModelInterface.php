<?php

/**
 * OpenApiModelInterface.
 *
 * PHP version 7.1
 *
 * @package OpenAPIServer\Mock
 * @author  Yuriy Belenko <yura-bely@mail.ru>
 * @link    https://github.com/ybelenko/openapi-data-mocker-interfaces
 * @license MIT
 */

namespace OpenAPIServer\Mock;

use JsonSerializable;

/**
 * OpenApiModelInterface.
 * All referenced($ref) models must implement this interface.
 */
interface OpenApiModelInterface extends JsonSerializable
{
    /**
     * Gets OAS 3.0 schema mapped to current class.
     *
     * @return array|object
     */
    public static function getOpenApiSchema();

    /**
     * Creates new instance from provided data.
     *
     * @param mixed $data Data with values for new instance.
     *
     * @return OpenApiModelInterface
     */
    public static function createFromData($data): OpenApiModelInterface;
}