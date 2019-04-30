<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function testRouteList()
    {
        $this->artisan('route:list')->assertExitCode(0);
    }
}
