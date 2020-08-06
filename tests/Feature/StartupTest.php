<?php

namespace Tests\Feature;

use App\Startup;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StartupTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStartupCreatedSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $startupData = [
            "name" => "Paystack",
            "sector" => "Fintech",
            "founded" => "2016",
            "headquarters" => "Lagos, Nigeria",
            "bio" => "Payments Processing Company. Stripe backed startup"
        ];

        $this->json('POST', 'api/startup', $startupData, ['Accept', 'application/json'])->assertStatus(201)->assertJson([
            "startup" => [
                "name" => "Paystack",
                "sector" => "Fintech",
                "founded" => "2016",
                "headquarters" => "Lagos, Nigeria",
                "bio" => "Payments Processing Company. Stripe backed startup"
            ],
            "message" => "Created Successfully"
        ]);
    }

    public function testStartupListedSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        factory(Startup::class)->create([
            "name" => "Paystack",
            "sector" => "Fintech",
            "founded" => "2016",
            "headquarters" => "Lagos, Nigeria",
            "bio" => "Payments Processing Company. Stripe backed startup"
        ]);

        factory(Startup::class)->create([
            "name" => "Taxify",
            "sector" => "Transport",
            "founded" => "2015",
            "headquarters" => "Norway",
            "bio" => "The closest to Uber"
        ]);

        $this->json('GET', 'api/startup', ['Accept', 'application/json'])->assertStatus(200)->assertJson(
            [
                "startups" => [
                    [
                        "id" => 1,
                        "name" => "Paystack",
                        "sector" => "Fintech",
                        "founded" => "2016",
                        "headquarters" => "Lagos, Nigeria",
                        "bio" => "Payments Processing Company. Stripe backed startup"
                    ],
                    [
                        "id" => 2,
                        "name" => "Taxify",
                        "sector" => "Transport",
                        "founded" => "2015",
                        "headquarters" => "Norway",
                        "bio" => "The closest to Uber"
                    ]
                ],
                "message" => "Retrieved Successfully"
            ]
        );

    }

    public function testRetrieveStartupSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $startup = factory(Startup::class)->create(["name" => "Paystack",
            "sector" => "Fintech",
            "founded" => "2016",
            "headquarters" => "Lagos, Nigeria",
            "bio" => "Payments Processing Company. Stripe backed startup"
        ]);

        $this->json('GET', 'api/startup/'.$startup->id, [], ['Accept' => 'application/json'])->assertStatus(200)->assertJson([
            "startup" => [
                "name" => "Paystack",
                "sector" => "Fintech",
                "founded" => "2016",
                "headquarters" => "Lagos, Nigeria",
                "bio" => "Payments Processing Company. Stripe backed startup"
            ],
            "message" => "Retrieved Successfully"
        ]);
    }

    public function testStartupUpdatedSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $startup = factory(Startup::class)->create([
            "name" => "Paystack",
            "sector" => "Fintech",
            "founded" => "2016",
            "headquarters" => "Lagos, Nigeria",
            "bio" => "Payments Processing Company. Stripe backed startup"
        ]);

        $updatedStartup = [
            "name" => "Pinpoint",
            "sector" => "Social",
            "founded" => "2016",
            "headquarters" => "Lagos, Nigeria",
            "bio" => "Payments Processing Company. Stripe backed startup"
        ];

        $this->json('PATCH', 'api/startup/' . $startup->id, $updatedStartup, ['Accept' => 'application/json'])->assertStatus(200)->assertJson(
            [
               "startup" => [
                    "name" => "Pinpoint",
                    "sector" => "Social",
                    "founded" => "2016",
                    "headquarters" => "Lagos, Nigeria",
                    "bio" => "Payments Processing Company. Stripe backed startup"
                ],
                "message" => "Retrived and Updated Successfully",
            ]
        );
    }

    public function testDeleteStartup()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $startup = factory(Startup::class)->create([
            "name" => "Paystack",
            "sector" => "Fintech",
            "founded" => "2016",
            "headquarters" => "Lagos, Nigeria",
            "bio" => "Payments Processing Company. Stripe backed startup"
        ]);


        $this->json('DELETE', 'api/startup/' . $startup->id, [], ['Accept' => 'application/json'])->assertStatus(204);
    }
}
