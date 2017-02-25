<?php

class AlidayuTest extends TestCase{

	public function test_is_instanceof_alidayu_client()
	{
		$alidayu = new Mingyoung\Alidayu\Client(appKey(), appSecret());

		$this->assertInstanceof(Mingyoung\Alidayu\Client::class, $alidayu);
	}
}