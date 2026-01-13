<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //
    protected function setUp(): void
    {
        parent::setUp();

        // Run migrations
        $this->artisan('migrate')->run();

        // Optional: seed test data if needed
        // $this->artisan('db:seed')->run();
    }
}
