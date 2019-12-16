<?php

declare(strict_types=1);

namespace LilleBitte\Emitter\Tests;

use LilleBitte\Emitter\Emitter;
use LilleBitte\Emitter\EmitterInterface;
use LilleBitte\Messenger\Response;
use PHPUnit\Framework\TestCase;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class EmitterTest extends TestCase
{
    /**
     * @var EmitterInterface
     */
    private $emitter;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        HeaderStack::reset();
        $this->emitter = new Emitter();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        HeaderStack::reset();
    }

    public function testCanEmitResponse()
    {
        $response = (new Response())
            ->withStatus(200)
            ->withHeader('X-Foo', 'foobarbaz')
            ->withHeader('Content-Type', 'text/plain');

        $response->getBody()->write("this is a text.");

        ob_start();
        $this->emitter->emit($response);
        ob_end_clean();

        $this->assertTrue(HeaderStack::has('HTTP/1.1 200 OK'));
        $this->assertTrue(HeaderStack::has('X-Foo: foobarbaz'));
        $this->assertTrue(HeaderStack::has('Content-Type: text/plain'));
    }
}
