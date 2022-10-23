<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_store_product_if_logged_in()
    {
        $user = User::factory()->create();
        $product = Product::factory()->make();

        $this
            ->withoutExceptionHandling()
            ->actingAs($user, 'sanctum') // simule la connexion
            ->post('/api/products', $product->toArray())
            ->assertExactJson([
                'status' => 'success',
                'message' => 'Produit enregistré avec succès'
            ]);

        $this->assertDatabaseHas('products', $product->toArray());
    }

    public function test_can_not_store_product_if_not_logged_in()
    {
        $product = Product::factory()->make();

        $this
//            ->withoutExceptionHandling()
            ->post('/api/products', $product->toArray())
            ->assertForbidden();
    }

    public function test_can_update_product_if_logged_in()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $product->name = fake()->word;

        $this
            ->withoutExceptionHandling()
            ->actingAs($user, 'sanctum') // simule la connexion
            ->patch('/api/products/' . $product->id, $product->toArray())
            ->assertExactJson([
                'status' => 'success',
                'message' => 'Produit modifié avec succès'
            ]);

        // on vérifie que l'élément existe en base de données
        $this->assertDatabaseHas('products', ['name' => $product->name]);
    }

    public function test_can_delete_product_if_logged_in()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this
            ->withoutExceptionHandling()
            ->actingAs($user, 'sanctum') // simule la connexion
            ->delete('/api/products/' . $product->id)
            ->assertExactJson([
                'status' => 'success',
                'message' => 'Produit supprimé avec succès'
            ]);

        // on vérifie que l'élément n'existe pas en base de données
        $this->assertDatabaseMissing('products', ['name' => $product->name]);
    }

    public function test_can_get_product_item_if_logged_in()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this
            ->withoutExceptionHandling()
            ->actingAs($user, 'sanctum') // simule la connexion
            ->get('/api/products/' . $product->id)
            ->assertExactJson($product->toArray());
    }

    public function test_can_get_product_collection_if_logged_in()
    {
        $user = User::factory()->create();
        Product::factory(2)->create();

        $response = $this
            ->withoutExceptionHandling()
            ->actingAs($user, 'sanctum')
            ->get('/api/products');

        $this->assertCount(2, $response->json('data'));
    }
}
