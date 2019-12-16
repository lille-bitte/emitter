<?php

declare(strict_types=1);

namespace LilleBitte\Emitter\Tests;

/**
 * Hook up the headers() PHP function for
 * command-line environment.
 *
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 * @param string $header Header string.
 * @param boolean $replace Replace a previous similar header or otherwise.
 * @param integer $http_response_code HTTP response code.
 * @return void
 */
function header(string $header, bool $replace = true, int $http_response_code = 200)
{
    HeaderStack::push(
        [
            'header' => $header,
            'replace' => $replace,
            'response_code' => $http_response_code
        ]
    );
}

/**
 * hook up the headers_sent() PHP functions for
 * command-line environment.
 *
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 * @param string|null $file PHP source file name.
 * @param string|null $line PHP source file line.
 * @return boolean
 */
function headers_sent(&$file = null, &$line = null)
{
    return false;
}
