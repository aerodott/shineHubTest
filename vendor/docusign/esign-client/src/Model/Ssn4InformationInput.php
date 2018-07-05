<?php
/**
 * Ssn4InformationInput
 *
 * PHP version 5
 *
 * @category Class
 * @package  DocuSign\eSign
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * DocuSign REST API
 *
 * The DocuSign REST API provides you with a powerful, convenient, and simple Web services API for interacting with DocuSign.
 *
 * OpenAPI spec version: v2
 * Contact: devcenter@docusign.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace DocuSign\eSign\Model;

use \ArrayAccess;

/**
 * Ssn4InformationInput Class Doc Comment
 *
 * @category    Class
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Ssn4InformationInput implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'ssn4InformationInput';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'display_level_code' => 'string',
        'receive_in_response' => 'string',
        'ssn4' => 'string'
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'display_level_code' => 'displayLevelCode',
        'receive_in_response' => 'receiveInResponse',
        'ssn4' => 'ssn4'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'display_level_code' => 'setDisplayLevelCode',
        'receive_in_response' => 'setReceiveInResponse',
        'ssn4' => 'setSsn4'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'display_level_code' => 'getDisplayLevelCode',
        'receive_in_response' => 'getReceiveInResponse',
        'ssn4' => 'getSsn4'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['display_level_code'] = isset($data['display_level_code']) ? $data['display_level_code'] : null;
        $this->container['receive_in_response'] = isset($data['receive_in_response']) ? $data['receive_in_response'] : null;
        $this->container['ssn4'] = isset($data['ssn4']) ? $data['ssn4'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        return true;
    }


    /**
     * Gets display_level_code
     * @return string
     */
    public function getDisplayLevelCode()
    {
        return $this->container['display_level_code'];
    }

    /**
     * Sets display_level_code
     * @param string $display_level_code Specifies the display level for the recipient.  Valid values are:   * ReadOnly * Editable * DoNotDisplay
     * @return $this
     */
    public function setDisplayLevelCode($display_level_code)
    {
        $this->container['display_level_code'] = $display_level_code;

        return $this;
    }

    /**
     * Gets receive_in_response
     * @return string
     */
    public function getReceiveInResponse()
    {
        return $this->container['receive_in_response'];
    }

    /**
     * Sets receive_in_response
     * @param string $receive_in_response When set to **true**, the information needs to be returned in the response.
     * @return $this
     */
    public function setReceiveInResponse($receive_in_response)
    {
        $this->container['receive_in_response'] = $receive_in_response;

        return $this;
    }

    /**
     * Gets ssn4
     * @return string
     */
    public function getSsn4()
    {
        return $this->container['ssn4'];
    }

    /**
     * Sets ssn4
     * @param string $ssn4 The last four digits of the recipient's Social Security Number (SSN).
     * @return $this
     */
    public function setSsn4($ssn4)
    {
        $this->container['ssn4'] = $ssn4;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\DocuSign\eSign\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\DocuSign\eSign\ObjectSerializer::sanitizeForSerialization($this));
    }
}


