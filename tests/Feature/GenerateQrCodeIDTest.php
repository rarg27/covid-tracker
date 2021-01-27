<?php

namespace Tests\Feature;


use App\Jobs\GenerateQrCodeID;
use App\Models\Resident;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateQrCodeIDTest extends TestCase
{
    use RefreshDatabase;

    public function testHandle()
    {
        $resident = Resident::first();

        $job = new GenerateQrCodeID($resident);
        $job->handle();
    }

}