<?php

declare(strict_types=1);

namespace LilleBitte\Emitter;

use Psr\Http\Message\ResponseInterface;

use function sprintf;
use function call_user_func_array;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
trait EmitterTrait
{
    /**
     * Send HTTP status line response to client.
     *
     * @param ResponseInterface $response Response object.
     * @return void
     */
    private function emitStatusLine(ResponseInterface $response)
    {
        $buf = sprintf(
            "HTTP/%s %d%s",
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            ($response->getReasonPhrase() !== ''
                ? sprintf(" %s", $response->getReasonPhrase())
                : ''
            )
        );

        call_user_func_array(
            (\PHP_SAPI === 'cli' ? '\LilleBitte\Emitter\Tests\header' : 'header'),
            [$buf, true, $response->getStatusCode()]
        );
    }

    /**
     * Send HTTP header response to client.
     *
     * @param ResponseInterface $response Response object.
     * @return void
     */
    private function emitHeaders(ResponseInterface $response)
    {
        foreach ($response->getHeaders() as $k => $v) {
            foreach ($v as $ev) {
                $buf = sprintf(
                    "%s: %s",
                    $k,
                    $ev
                );

                call_user_func_array(
                    (\PHP_SAPI === 'cli' ? '\LilleBitte\Emitter\Tests\header' : 'header'),
                    [$buf, true, $response->getStatusCode()]
                );
            }
        }
    }

    /**
     * Send HTTP response body to client.
     *
     * @param ResponseInterface $response Response object.
     * @return void
     */
    private function emitContents(ResponseInterface $response)
    {
        echo sprintf("%s", $response->getBody());
    }
}
