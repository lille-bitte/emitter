<?php

declare(strict_types=1);

namespace LilleBitte\Emitter;

use Psr\Http\Message\ResponseInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface EmitterInterface
{
    /**
     * Send HTTP response to client.
     *
     * @param ResponseInterface $response
     * @return bool
     */
    public function emit(ResponseInterface $response): bool;
}
