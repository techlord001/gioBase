<?php

namespace Tests\Feature;

use App\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_view_label_index_page()
    {
        $response = $this->get('/labels');

        $labels = Label::all();

        $response->assertSuccessful();
        $response->assertHeader("host", "127.0.0.1:8000");
    }
}
