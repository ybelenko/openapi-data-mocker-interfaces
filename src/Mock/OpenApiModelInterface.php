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
     * @return array
     */
    public static function getOpenApiSchema(): array;

    /**
     * Creates new instance from provided data.
     *
     * @param mixed $data Data with values for new instance.
     *
     * @return OpenApiModelInterface
     */
    public static function createFromData($data): OpenApiModelInterface;
}
