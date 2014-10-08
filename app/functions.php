<?php

/**
 * @param array $array
 * @param string|int $key
 * @param mixed $default
 * @param bool $checkEmpty
 * @return mixed
 */
function getArrayValue($array, $key, $default = null, $checkEmpty = false)
{
    if (!is_array($array)) {
        return $default;
    }
    if (is_scalar($key)) {
        $key = [$key];
    }
    if (!is_array($key)) {
        return $default;
    }
    foreach ($key as $subKey) {
        if (!isset($array[$subKey])) {
            return $default;
        }
        $array = $array[$subKey];
    }
    if ($checkEmpty && empty($array)) {
        return $default;
    }

    return $array;
}
