<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

if (!function_exists('associative_to_flat')) {
    /**
     * Get specific value by its key from a associative array as a flat array
     *
     * @param array $associativeArray
     * @param string $key key of value need to get
     * @return array
     */
    function associative_to_flat(array $associativeArray, $key = 'id')
    {
        if (!empty($associativeArray)) {
            return array_map(function ($value) use ($key) {
                if (key_exists($key, $value)) {
                    return $value[$key];
                }
            }, $associativeArray);
        }
        return [];
    }
}
