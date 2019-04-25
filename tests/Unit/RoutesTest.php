<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function testRouteList()
    {
        $returnCode = $this->artisan('route:list');
        $this->assertEquals(0, $returnCode);
    }
}
