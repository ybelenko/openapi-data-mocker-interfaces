<?php

/**
 * Openapi Data Mocker Interfaces
 * PHP version 7.2
 *
 * @package OpenAPIServer\Mock
 * @link    https://github.com/ybelenko/openapi-data-mocker-interfaces
 * @author  Yuriy Belenko <yura-bely@mail.ru>
 * @license MIT
 */

declare(strict_types=1);

namespace OpenAPIServer\Mock;

use OpenAPIServer\Mock\Exceptions\OpenApiDataMockerException;

/**
 * OpenApiDataMockerInterface.
 *
 * @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.1.md#data-types
 */
interface OpenApiDataMockerInterface
{
    /**
     * CodeSniffer asks for a full doc blocks even for constants, let's disable it.
     * phpcs:disable Generic.Commenting.DocComment
     */

    /** @var string DATA_TYPE_INTEGER  */
    public const DATA_TYPE_INTEGER = 'integer';

    /** @var string DATA_TYPE_NUMBER  */
    public const DATA_TYPE_NUMBER = 'number';

    /** @var string DATA_TYPE_STRING */
    public const DATA_TYPE_STRING = 'string';

    /** @var string DATA_TYPE_BOOLEAN */
    public const DATA_TYPE_BOOLEAN = 'boolean';

    /** @var string DATA_TYPE_ARRAY */
    public const DATA_TYPE_ARRAY = 'array';

    /** @var string DATA_TYPE_OBJECT */
    public const DATA_TYPE_OBJECT = 'object';

    /** @var string DATA_FORMAT_INT32 Signed 32 bits */
    public const DATA_FORMAT_INT32 = 'int32';

    /** @var string DATA_FORMAT_INT64 Signed 64 bits */
    public const DATA_FORMAT_INT64 = 'int64';

    /** @var string DATA_FORMAT_FLOAT */
    public const DATA_FORMAT_FLOAT = 'float';

    /** @var string DATA_FORMAT_DOUBLE */
    public const DATA_FORMAT_DOUBLE = 'double';

    /** @var string DATA_FORMAT_BYTE base64 encoded characters */
    public const DATA_FORMAT_BYTE = 'byte';

    /** @var string DATA_FORMAT_BINARY Any sequence of octets */
    public const DATA_FORMAT_BINARY = 'binary';

    /** @var string DATA_FORMAT_DATE As defined by full-date [RFC3339](http://xml2rfc.ietf.org/public/rfc/html/rfc3339.html#anchor14) */
    public const DATA_FORMAT_DATE = 'date';

    /** @var string DATA_FORMAT_DATE_TIME As defined by date-time [RFC3339](http://xml2rfc.ietf.org/public/rfc/html/rfc3339.html#anchor14) */
    public const DATA_FORMAT_DATE_TIME = 'date-time';

    /** @var string DATA_FORMAT_PASSWORD Used to hint UIs the input needs to be obscured. */
    public const DATA_FORMAT_PASSWORD = 'password';

    /** @var string DATA_FORMAT_EMAIL */
    public const DATA_FORMAT_EMAIL = 'email';

    /** @var string DATA_FORMAT_UUID */
    public const DATA_FORMAT_UUID = 'uuid';
    // phpcs:enable

    /**
     * Mocks OpenApi Data. @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.1.md#data-types
     *
     * @param string     $dataType   OpenApi data type. Use constants from this class.
     * @param string     $dataFormat OpenApi data format.
     * @param array|null $options    OpenApi data options.
     *
     * @throws OpenApiDataMockerException When invalid arguments passed.
     *
     * @return mixed
     */
    public function mock(
        string $dataType,
        ?string $dataFormat = null,
        ?array $options = []
    );

    /**
     * Shortcut to mock integer type
     * Equivalent to mockData(DATA_TYPE_INTEGER);
     *
     * @param string|null $dataFormat       Possible values: int32 or int64.
     * @param float|null  $minimum          Default is 0.
     * @param float|null  $maximum          Default is mt_getrandmax().
     * @param bool|null   $exclusiveMinimum Default is false.
     * @param bool|null   $exclusiveMaximum Default is false.
     *
     * @throws OpenApiDataMockerException When $maximum less than $minimum or invalid arguments provided.
     *
     * @return int
     */
    public function mockInteger(
        ?string $dataFormat = null,
        ?float $minimum = null,
        ?float $maximum = null,
        ?bool $exclusiveMinimum = false,
        ?bool $exclusiveMaximum = false
    ): int;

    /**
     * Shortcut to mock number type
     * Equivalent to mockData(DATA_TYPE_NUMBER);
     *
     * @param string|null $dataFormat       Possible values: float or double.
     * @param float|null  $minimum          Default is 0.
     * @param float|null  $maximum          Default is mt_getrandmax().
     * @param bool|null   $exclusiveMinimum Default is false.
     * @param bool|null   $exclusiveMaximum Default is false.
     *
     * @throws OpenApiDataMockerException When $maximum less than $minimum or invalid arguments provided.
     *
     * @return float
     */
    public function mockNumber(
        ?string $dataFormat = null,
        ?float $minimum = null,
        ?float $maximum = null,
        ?bool $exclusiveMinimum = false,
        ?bool $exclusiveMaximum = false
    ): float;

    /**
     * Shortcut to mock string type
     * Equivalent to mockData(DATA_TYPE_STRING);
     *
     * @param string|null $dataFormat Possible values: byte, binary, date, date-time, password.
     * @param int|null    $minLength  Default is 0.
     * @param int|null    $maxLength  Default is 100 chars.
     * @param array       $enum       This array should have at least one element.
     *                                Elements in the array should be unique.
     * @param string|null $pattern    This string should be a valid regular expression, according to the ECMA 262 regular expression dialect.
     *                                Recall: regular expressions are not implicitly anchored.
     *
     * @throws OpenApiDataMockerException When invalid arguments passed.
     *
     * @return string
     */
    public function mockString(
        ?string $dataFormat = null,
        ?int $minLength = 0,
        ?int $maxLength = null,
        ?array $enum = null,
        ?string $pattern = null
    ): string;

    /**
     * Shortcut to mock boolean type
     * Equivalent to mockData(DATA_TYPE_BOOLEAN);
     *
     * @return bool
     */
    public function mockBoolean(): bool;

    /**
     * Shortcut to mock array type
     * Equivalent to mockData(DATA_TYPE_ARRAY);
     *
     * @param array     $items       Assoc array of described items.
     * @param int|null  $minItems    An array instance is valid against "minItems" if its size is greater than, or equal to, the value of this keyword.
     * @param int|null  $maxItems    An array instance is valid against "maxItems" if its size is less than, or equal to, the value of this keyword.
     * @param bool|null $uniqueItems If it has boolean value true, the instance validates successfully if all of its elements are unique.
     *
     * @throws OpenApiDataMockerException When invalid arguments passed.
     *
     * @return array
     */
    public function mockArray(
        array $items,
        ?int $minItems = 0,
        ?int $maxItems = null,
        ?bool $uniqueItems = false
    ): array;

    /**
     * Shortcut to mock object type.
     * Equivalent to mockData(DATA_TYPE_OBJECT);
     *
     * @param array                  $properties           Assoc array of described properties.
     * @param int|null               $minProperties        An object instance is valid against "minProperties" if its number of properties is greater than, or equal to, the value of this keyword.
     * @param int|null               $maxProperties        An object instance is valid against "maxProperties" if its number of properties is less than, or equal to, the value of this keyword.
     * @param bool|object|array|null $additionalProperties If "additionalProperties" is true, validation always succeeds.
     *                                                     If "additionalProperties" is false, validation succeeds only if the instance is an object and all properties on the instance were covered by "properties" and/or "patternProperties".
     *                                                     If "additionalProperties" is an object, validate the value as a schema to all of the properties that weren't validated by "properties" nor "patternProperties".
     * @param array|null             $required             This array MUST have at least one element.  Elements of this array must be strings, and MUST be unique.
     *                                                     An object instance is valid if its property set contains all elements in this array value.
     *
     * @throws OpenApiDataMockerException When invalid arguments passed.
     *
     * @return object
     */
    public function mockObject(
        array $properties,
        ?int $minProperties = 0,
        ?int $maxProperties = null,
        $additionalProperties = null,
        ?array $required = null
    ): object;

    /**
     * Mocks OpenApi Data from schema.
     *
     * @param array $schema OpenAPI schema.
     *
     * @throws OpenApiDataMockerException When invalid arguments passed.
     *
     * @return mixed
     */
    public function mockFromSchema(array $schema);
}
