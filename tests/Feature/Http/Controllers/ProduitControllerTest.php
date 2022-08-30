<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Produit;
use App\Notification\ProduitStoreNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProduitController
 */
class ProduitControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $produits = Produit::factory()->count(3)->create();

        $response = $this->get(route('produit.index'));

        $response->assertOk();
        $response->assertViewIs('produits.index');
        $response->assertViewHas('produits');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $produit = Produit::factory()->create();

        $response = $this->get(route('produit.show', $produit));

        $response->assertOk();
        $response->assertViewIs('produits.show');
        $response->assertViewHas('produit');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProduitController::class,
            'store',
            \App\Http\Requests\ProduitStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $titre = $this->faker->word;
        $slug = $this->faker->slug;
        $prix = $this->faker->numberBetween(-10000, 10000);
        $is_available = $this->faker->boolean;

        Notification::fake();

        $response = $this->post(route('produit.store'), [
            'titre' => $titre,
            'slug' => $slug,
            'prix' => $prix,
            'is_available' => $is_available,
        ]);

        $produits = Produit::query()
            ->where('titre', $titre)
            ->where('slug', $slug)
            ->where('prix', $prix)
            ->where('is_available', $is_available)
            ->get();
        $this->assertCount(1, $produits);
        $produit = $produits->first();

        $response->assertRedirect(route('produits.index'));

        Notification::assertSentTo($produit->user, ProduitStoreNotification::class, function ($notification) use ($produit) {
            return $notification->produit->is($produit);
        });
    }
}
