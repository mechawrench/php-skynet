<?php

namespace Mechawrench\PhpSkynet\Tests\Integration;

use Mechawrench\PhpSkynet\PhpSkynet;
use Mechawrench\PhpSkynet\Tests\TestCase;

class PhpSkynetTest extends TestCase
{
    /** @test */
    public function upload_can_upload_to_siad()
    {
        $upload = PhpSkynet::uploadSiad('php-skynet-TEST.png', env('EXAMPLE_FILE'), env('SIAD_HOST'), env('SIAD_API_KEY'));

        $this->assertNotNull($upload['skylink']);
        $this->assertNotNull($upload['merkleroot']);
        $this->assertNotNull($upload['bitfield']);
    }

    /** @test */
    public function upload_requires_a_valid_apiKey()
    {
        $upload = PhpSkynet::uploadSiad('php-skynet.png', env('EXAMPLE_FILE'), env('SIAD_HOST'), 'invalidKey');

        $this->assertEquals('API authentication failed.', $upload['message']);
    }


    /** @test */
    public function it_can_download_a_file_over_siad()
    {
        $skyLink = 'GAAGFVdQTCpf43KH7Wami5iNldaEHbyxQXhjDkd_ifob2g';

        $download = PhpSkynet::downloadSiad($skyLink, 'Bitcoin.png', env('SIAD_HOST'));

        $this->assertTrue($download);
    }

    /** @test */
    public function it_can_download_a_file_over_siad_without_a_file_name()
    {
        $skyLink = 'GAAGFVdQTCpf43KH7Wami5iNldaEHbyxQXhjDkd_ifob2g';

        $download = PhpSkynet::downloadSiad($skyLink, null, env('SIAD_HOST'));

        $this->assertTrue($download);
    }

    /** @test */
    public function it_can_upload_to_a_portal()
    {
        $upload = PhpSkynet::upload(env('EXAMPLE_FILE'), env('SKYNET_DEFAULT_PORTAL_URL'));

        $this->assertNotNull($upload['skylink']);
        $this->assertNotNull($upload['merkleroot']);
        $this->assertNotNull($upload['bitfield']);
    }

    /** @test */
    public function it_can_download_a_file_over_portal_without_a_file_name()
    {
        $skyLink = 'GAAGFVdQTCpf43KH7Wami5iNldaEHbyxQXhjDkd_ifob2g';

        $download = PhpSkynet::download($skyLink, env('SKYNET_DEFAULT_PORTAL_URL'));

        $this->assertTrue($download);
    }
}
