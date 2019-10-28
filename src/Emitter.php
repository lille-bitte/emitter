<?php

declare(strict_types=1);

namespace LilleBitte\Emitter;

use Psr\Http\Message\ResponseInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Emitter implements EmitterInterface
{
	use EmitterTrait;

	/**
	 * {@inheritdoc}
	 */
	public function emit(ResponseInterface $response): bool
	{
		$this->emitStatusLine($response);
		$this->emitHeaders($response);
		$this->emitContents($response);

		return true;
	}
}
