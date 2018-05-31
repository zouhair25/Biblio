<?php

namespace PFE\DashBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BibControllerTest extends WebTestCase
{
    public function testPresentation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/presentation');
    }

    public function testEspaces()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/espaces');
    }

    public function testEquipements()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/equipements');
    }

    public function testFonds()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fonds');
    }

    public function testCatalogues()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalogues');
    }

    public function testPrets()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/prets');
    }

    public function testAnimations()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/animations');
    }

    public function testRemarques()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/remarques');
    }

}
