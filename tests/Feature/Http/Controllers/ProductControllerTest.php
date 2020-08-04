<?php

namespace Tests\Feature\Http\Controllers;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $products = factory(Product::class, 3)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertJson($product.show);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $name = $this->faker->name;
        $description = $this->faker->text;
        $short_description = $this->faker->text;
        $price = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('product.store'), [
            'name' => $name,
            'description' => $description,
            'short_description' => $short_description,
            'price' => $price,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('short_description', $short_description)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertOk();
        $response->assertJson($product.show);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_saves_and_responds_with()
    {
        $product = factory(Product::class)->create();
        $name = $this->faker->name;
        $description = $this->faker->text;
        $short_description = $this->faker->text;
        $price = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('product.update', $product), [
            'name' => $name,
            'description' => $description,
            'short_description' => $short_description,
            'price' => $price,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('short_description', $short_description)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertOk();
        $response->assertJson($product.show);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $product = factory(Product::class)->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertOk();
        $response->assertJson($product.show);

        $this->assertDeleted($product);
    }
}
