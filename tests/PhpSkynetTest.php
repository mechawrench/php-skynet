<?php

namespace Mechawrench\PhpSkynet\Tests;

use Mechawrench\PhpSkynet\PhpSkynet;

class PhpSkynetTest extends TestCase
{
    /** @test */
    public function upload_requires_a_filename()
    {
        $upload = PhpSkynet::uploadSiad('', env('EXAMPLE_FILE'), env('SIAD_HOST'), env('SIAD_API_KEY'));

        $this->assertEquals('Filename is required', $upload['error']);
    }

    /** @test */
    public function upload_requires_a_filepath()
    {
        $upload = PhpSkynet::uploadSiad('php-skynet.png', '', env('SIAD_HOST'), env('SIAD_API_KEY'));

        $this->assertEquals('File (path) is required', $upload['error']);
    }
}
