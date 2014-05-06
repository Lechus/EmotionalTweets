<?php

class ExampleTest extends TestCase
{

    /**
     * A basic functional test GET.
     *
     * @return void
     */
    public function testShowSearchFormPage()
    {

        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());

        $this->assertCount(1, $crawler->filter('h1:contains("Search for tweets:")'));
    }

}
