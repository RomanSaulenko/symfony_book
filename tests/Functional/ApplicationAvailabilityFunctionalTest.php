<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider successUrlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    public function successUrlProvider()
    {
        yield ['/authors'];
        yield ['/authors/create'];
        yield ['/books'];
        yield ['/books/create'];
    }

    /**
     * @dataProvider redirectUrlProvider
     */
    public function testPageIsRedirect($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseRedirects();
    }

    public function redirectUrlProvider()
    {
        yield ['/'];
    }
}