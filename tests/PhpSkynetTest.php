<?php

namespace Mechawrench\PhpSkynet\Tests;

use Mechawrench\PhpSkynet\PhpSkynet;

class PhpSkynetTest extends TestCase
{
    /** @test */
    public function upload_requires_a_filename()
    {
        $upload = PhpSkynet::uploadSiad('', env('EXAMPLE_FILE'), '127.0.0.1:9980', 'siad-api-key');

        $this->assertEquals('Filename is required', $upload['error']);
    }

    /** @test */
    public function upload_requires_a_filepath()
    {
        $upload = PhpSkynet::uploadSiad('php-skynet.png', '','127.0.0.1:9980', 'siad-api-key');

        $this->assertEquals('File (path) is required', $upload['error']);
    }
}
