<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesWebTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedirectHome()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testGetInscricao()
    {
        $response = $this->get('/inscricao');

        $response->assertStatus(200);
    }

    public function testGetPagamentos()
    {
        $response = $this->get('/api/pagamentos');

        $response->assertStatus(200);
    }
}
