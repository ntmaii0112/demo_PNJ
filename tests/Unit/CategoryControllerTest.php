<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\CategoryController;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new CategoryController();
    }

    /** @test */
    public function it_displays_category_index_page()
    {
        Category::create(['name' => 'Category 1']);
        Category::create(['name' => 'Category 2']);

        $request = new Request();
        $response = $this->controller->index($request);

        $this->assertEquals('admin.category.index', $response->getName());
        $this->assertArrayHasKey('Category', $response->getData());
        $this->assertCount(2, $response->getData()['Category']);
    }

    /** @test */
    public function it_filters_categories_by_search_term()
    {
        Category::create(['name' => 'Test Category']);
        Category::create(['name' => 'Another Category']);

        $request = new Request(['search' => 'Test']);
        $response = $this->controller->index($request);
        $categories = $response->getData()['Category'];

        $this->assertCount(1, $categories);
        $this->assertEquals('Test Category', $categories[0]->name);
    }

    /** @test */
    public function it_stores_a_new_category()
    {
        $uniqueName = 'New Category ' . Str::random(5);
        $request = new Request([
            'name' => $uniqueName
        ]);

        $response = $this->controller->store($request);

        $this->assertDatabaseHas('categories', ['name' => $uniqueName]);
        $this->assertEquals(route('category.index'), $response->getTargetUrl());
        $this->assertTrue(session()->has('success'));
    }

    /** @test */
    public function it_validates_store_request()
    {
        $this->withoutExceptionHandling(); // Remove this if you want to test the redirect behavior

        $request = new Request([
            'name' => ''
        ]);

        try {
            $response = $this->controller->store($request);
            // If we get here, validation passed unexpectedly
            $this->fail('Validation should have failed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->assertDatabaseCount('categories', 0);
            $this->assertEquals(
                ['name' => ['The name field is required.']],
                $e->errors()
            );
        }
    }

    /** @test */
    public function it_updates_an_existing_category()
    {
        $category = Category::create(['name' => 'Old Name']);
        $newName = 'Updated Name ' . Str::random(5);

        $request = new Request([
            'name' => $newName
        ]);

        $response = $this->controller->update($request, $category);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $newName
        ]);
        $this->assertEquals(route('category.index'), $response->getTargetUrl());
        $this->assertTrue(session()->has('success'));
    }

    /** @test */
    public function it_deletes_a_category()
    {
        // Create a category with del_flag = false
        $category = Category::create([
            'name' => 'Test Category',
            'del_flag' => false
        ]);

        // Call the destroy method
        $response = $this->controller->destroy($category->id);

        // Assert the category was soft deleted
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'del_flag' => true
        ]);

        // Assert redirect with success message
        $this->assertEquals(route('category.index'), $response->getTargetUrl());
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Category has been deleted', session()->get('success'));
    }

    /** @test */
    public function it_logs_important_actions()
    {
        Log::shouldReceive('info')
            ->with('Hiển thị trang quản lý category')
            ->once();

        Log::shouldReceive('info')
            ->with('Category created successfully')
            ->once();

        Log::shouldReceive('info')
            ->with('Category updated successfully')
            ->once();

        $this->controller->index(new Request());
        $this->controller->store(new Request(['name' => 'Test ' . Str::random(5)]));

        $category = Category::create(['name' => 'Test ' . Str::random(5)]);
        $this->controller->update(new Request(['name' => 'Updated']), $category);
    }
}
