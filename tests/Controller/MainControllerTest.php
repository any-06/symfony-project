<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class MainControllerTest extends WebTestCase
{
    protected $client;

    protected $databaseTool;

    protected function setUp(): void
    {
        $this->client = self::createClient();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();

        $this->databaseTool->loadAliceFixture([
            dirname(__DIR__) . '/Fixtures/UserFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/TagFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/ArticleFixtures.yaml'
        ]);
    }

    public function testGetHomePage()
    {
        $this->client->request('GET', '/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHeading1HomePage()
    {
        $this->client->request('GET', '/');

        $this->assertSelectorTextContains('h1.title', 'Bienvenue sur l\'Application Symfony 6');
    }

    public function testNavbarHomePage()
    {
        $this->client->request('GET', '/');

        $this->assertSelectorExists('header');
    }

    /*
    public function testFooterHomePage()
    {
        $this->client->request('GET', '/');

        $this->assertSelectorExists('footer');
    }
    */

    public function testArticlesNumberHomePage()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertCount(6, $crawler->filter('.blog-card'));
    }
}
