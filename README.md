# OpenApi Data Mocker Interfaces
This repository holds interfaces to generate fake data from OpenAPI Specification(OAS3). Note that this is not an implementation.

## Requirements
PHP 7.2 or newer. It could work with older versions, but it's not worth to support _EOL(end of life)_ PHP.

## Interfaces
|                                           Class Name                                         | Description |
|----------------------------------------------------------------------------------------------|-------------|
| [OpenAPIServer\Mock\OpenApiModelInterface](src/Mock/OpenApiModelInterface.php)               | All referenced components must implement that interface. |
| [OpenAPIServer\Mock\OpenApiDataMockerInterface](src/Mock/OpenApiDataMockerInterface.php)     | Basic data generator. Can mock scalar data types. |
| [OpenAPIServer\Mock\OpenApiServerMockerInterface](src/Mock/OpenApiServerMockerInterface.php) | Enhanced data generator. Can mock server request and server response. |

### `OpenAPIServer\Mock\OpenApiDataMockerInterface` Constants
[OpenAPISpecification - Data Types](https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#dataTypes)

| Constant Name           | Referenced OAS type | Referenced OAS format |
|:-----------------------:|:-------------------:|:---------------------:|
| `DATA_TYPE_INTEGER`     |     `integer`       |                       |
| `DATA_TYPE_NUMBER`      |     `number`        |                       |
| `DATA_TYPE_STRING`      |     `string`        |                       |
| `DATA_TYPE_BOOLEAN`     |     `boolean`       |                       |
| `DATA_TYPE_FILE`        |                     |                       |
| `DATA_TYPE_ARRAY`       |     `array`         |                       |
| `DATA_TYPE_OBJECT`      |     `object`        |                       |
| `DATA_FORMAT_INT32`     |                     |        `int32`        |
| `DATA_FORMAT_INT64`     |                     |        `int64`        |
| `DATA_FORMAT_FLOAT`     |                     |        `float`        |
| `DATA_FORMAT_DOUBLE`    |                     |        `double`       |
| `DATA_FORMAT_BYTE`      |                     |         `byte`        |
| `DATA_FORMAT_BINARY`    |                     |        `binary`       |
| `DATA_FORMAT_DATE`      |                     |         `date`        |
| `DATA_FORMAT_DATE_TIME` |                     |       `date-time`     |
| `DATA_FORMAT_PASSWORD`  |                     |       `password`      |
| `DATA_FORMAT_EMAIL`     |                     |                       |
| `DATA_FORMAT_UUID`      |                     |                       |

### `OpenAPIServer\Mock\OpenApiDataMockerInterface` Methods

|                    Method Name                      |                    Description                  | Return Type |
|-----------------------------------------------------|-------------------------------------------------|:-----------:|
| `mock($dataType, $dataFormat = null, $options = [])`| Mocks OpenApi Data.                             |   `mixed`   |
| `mockInteger($dataFormat = null, $minimum = null, $maximum = null, $exclusiveMinimum = false, $exclusiveMaximum = false)` | Shortcut to mock integer type. Equivalent to `mockData(DATA_TYPE_INTEGER)`\*. | `int`  |
| `mockNumber($dataFormat = null, $minimum = null, $maximum = null, $exclusiveMinimum = false, $exclusiveMaximum = false)` | Shortcut to mock number type. Equivalent to `mockData(DATA_TYPE_NUMBER)`\*. | `float` |
| `mockString($dataFormat = null, $minLength = 0, $maxLength = null, $enum = null, $pattern = null)` | Shortcut to mock string type. Equivalent to `mockData(DATA_TYPE_STRING)`\*. | `string` |
| `mockBoolean()` | Shortcut to mock boolean type. Equivalent to `mockData(DATA_TYPE_BOOLEAN)`\* | `bool` |
| `mockArray($items, $minItems = 0, $maxItems = null, $uniqueItems = false)` | Shortcut to mock array type. `Equivalent to mockData(DATA_TYPE_ARRAY)`\*. | `array` |
| `mockObject($properties, $minProperties = 0, $maxProperties = null, $additionalProperties = null, $required = null)` | Shortcut to mock object type. Equivalent to `mockData(DATA_TYPE_OBJECT)`\*. | `object` |
| `mockFromSchema($schema)` | Mocks OpenApi Data from schema. | `mixed` |

\* constant class is omitted, so `mockData(DATA_TYPE_INTEGER)` means `mockData(\OpenAPIServer\Mock\OpenApiDataMockerInterface\DATA_TYPE_INTEGER)`.

### `OpenAPIServer\Mock\OpenApiModelInterface` Methods
|                    Method Name                      |                                       Description                                    | Return Type |
|-----------------------------------------------------|--------------------------------------------------------------------------------------|:-----------:|
| static `getOpenApiSchema()`                         | Gets OAS 3.0 schema mapped to current class.                                         |   `array`   |
| static `createFromData($data)`                      | Creates new instance from provided data.                                             |   `OpenAPIServer\Mock\OpenApiModelInterface`   |
| `jsonSerialize()` inherited from `JsonSerializable` | Serializes the object to a value that can be serialized natively by `json_encode()`. |   `mixed`   |

### `OpenAPIServer\Mock\OpenApiServerMockerInterface` Methods
Same methods as `OpenAPIServer\Mock\OpenApiDataMockerInterface` + following methods:

|           Method Name           |         Description          |               Return Type                 |
|---------------------------------|------------------------------|:-----------------------------------------:|
| `mockRequest($requestSchema)`   | Mocks PSR-7 server request.  | `Psr\Http\Message\ServerRequestInterface` |
| `mockResponse($responseSchema)` | Mocks PSR-7 server response. | `Psr\Http\Message\ResponseInterface`      |

## Related Packages
* [Openapi Data Mocker](https://github.com/ybelenko/openapi-data-mocker) - first implementation of OAS3 fake data generator.
* [Openapi Data Mocker Server Middleware](https://github.com/ybelenko/openapi-data-mocker-server-middleware) - PSR-15 HTTP server middleware.

## Copyright
While author of this package is top contributor to OpenAPI-Generator project he's not member of OpenAPI Initiative (OAI).

