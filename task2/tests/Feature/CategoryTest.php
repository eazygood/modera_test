<?php

namespace Tests\Feature;
use App\User;
use App\Category;
use App\Http\Controllers\Items;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    protected function headers($user = null) {
    	$headers = ['Accept' => 'application/json'];

    	if (!is_null($user)) {
    		$token = $user->generateToken();
    		$headers['Accept'] = 'applications/json';
    		$headers['Authorization'] = 'Bearer ' . $token;
    	}

    	return $headers;
    }

    public function testCategoryAreListedCorrectly() {
    	$user = factory(User::class)->create();
  
    	
    	$response = $this->json('GET', '/api/category', [], $this->headers($user))
    				->assertStatus(200)
    				->assertJsonStructure([
    					'*' => ['id', 'parent_id', 'name']
    				]);
    }
    
    public function testSubCategoryAreListedCorrectly() {
    	$user = factory(User::class)->create();
  
    	
    	$response = $this->json('GET', '/api/category/subcategory/1', [], $this->headers($user))
    				->assertStatus(200)
    				->assertJsonStructure([
    					'*' => ['id', 'parent_id', 'name']
    				]);
    }
    
     public function testCategoryNameAreListedCorrectly() {
    	$user = factory(User::class)->create();
    	$category = factory(Category::class)->create([
    				'parent_id' => 13,
    				'name' => 'Kitty'
    			]);
  
    	
    	$response = $this->json('GET', '/api/category/name/'. $category->name, $this->headers($user))
    				->assertStatus(200)
    				->assertJsonStructure([
    					'*' => ['id', 'parent_id', 'name']
    				]);
    }

    // public function testCategoryCreatedCorrectly() {
    // 	$user = factory(User::class)->create();
    // 	$payload = [
    // 		'parent_id' => '12',
    // 		'name' => 'Toys'
    // 	];

    // 	$response = $this->json('POST', '/api/category', $payload, $this->headers($user))
    // 									 ->assertStatus(201)
    // 									 ->assertJson([
    // 									 	'id' => 16, 'parent_id' => 12, 'name' => 'Toys'
    // 									 ]);
    // }
    
    public function testCategoryAreUpdatedCorrectly() {
    		$user = factory(User::class)->create();
    		$category = factory(Category::class)->create([
    				'parent_id' => 2,
    				'name' => 'Body body'
    			]);

	    	$payload = [
	    		'parent_id' => 13,
	    		'name' => 'Hello Kitty'
	    	];

    	$response = $this->json('PUT', '/api/category/' . $category->id, $payload, $this->headers($user))
    									 ->assertStatus(200)
    									 ->assertJson([
    									 	'id' => $category->id,
    									 	'parent_id' => 13,
    									 	'name' => 'Hello Kitty'
    									 ]);
    }
    
    public function testCategoryAreDeletedCorrectly() {
    	$user = factory(User::class)->create();
    	$category = factory(Category::class)->create([
    				'parent_id' => 13,
    				'name' => 'TestProduct'
    			]);

    	$response = $this->json('DELETE', '/api/category/' . $category->id, [], $this->headers($user))
    									 ->assertStatus(204);
    }

    
}
