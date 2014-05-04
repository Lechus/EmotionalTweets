<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test GET.
	 *
	 * @return void
	 */
	public function testBasicGetRoot()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}
    


}
