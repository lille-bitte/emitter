<?php

namespace LilleBitte\Emitter\Tests;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class HeaderStack
{
    /**
     * @var array
     */
    private static $data = [];

    /**
     * Reset header stack.
     *
     * @return void
     */
    public static function reset()
    {
        self::$data = [];
    }

    /**
     * Push HTTP header into stack.
     *
     * @param array $header Header data.
     * @return void
     */
    public static function push(array $header)
    {
        self::$data[] = $header;
    }

    /**
     * Get HTTP header stack.
     *
     * @return array
     */
    public static function stack()
    {
        return self::$data;
    }

    /**
     * Check if header string exists in
     * HTTP header stack.
     *
     * @param string $header Header value.
     * @return boolean
     */
    public static function has($header)
    {
        foreach (self::$data as $key => $value) {
            if ($value['header'] === $header) {
                return true;
            }
        }

        return false;
    }
}
