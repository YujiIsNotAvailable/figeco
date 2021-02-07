<?php
namespace Figeco;

/**
 * Encode Key and/or Value of Query parameters
 */
final class EncodeQueryOptions 
{
    /**
     * Default.
     * http build query => PHP_QUERY_RFC3986
     */
    public const ENCODE_BOTH = 'encode_value';

    /**
     * Encode only $key
     */
    public const ENCODE_KEY = 'encode_key';

    /**
     * Encode only $value
     */
    public const ENCODE_VALUE = 'encode_value';
}