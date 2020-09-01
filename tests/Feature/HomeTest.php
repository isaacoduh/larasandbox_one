<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');
        $response->assertSee('Welcome to Laravel!');
        $response->assertSeeText('This is content of the main page!');
    }

    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact');
        $response->assertSeeText('Hello this is contact!');
    }
}
