<?php

namespace Tests\Unit;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
     /** @test */
    public function testIndex()
    {
      $this->withoutMiddleware();
      $response = $this->get(route('admincarindex'));
      $response->assertStatus(200);
      $response->assertViewIs('cars.dashboard');
      
      
      
    }
    /** @test */
    public function testStore(){

      $this->withoutMiddleware();
     
      $request = new Request([
        'user_id' => 2,
        'make'=> 'Test car',
        'model'=> 'Tdsa',
        'year'=> 1000,
        
      ]);
    
      $response = $this->post(route('admincarstore'), $request ->toArray());
      // $response->assertStatus(302);
      // $response->assertViewIs('cars.edit');
      $this->assertDatabaseHas('cars',[
        
        'make'=> 'Test car',
        'model'=> 'T',
        'year'=> 1000,
      ]);
      



    }
    /** @test */
    public function testCreate(){
      
      $this->withoutMiddleware();
      $response = $this->get(route('admincarcreate'));
      $response->assertViewIs('cars.create');
      $response->assertStatus(200);
    }

   /** @test */
    public function testDestroy()
    {

      $this->withoutMiddleware();
        // Creating a test car
        $car = Car::factory()->create();

        // Making a DELETE request to the destroy method
        $response = $this->delete(route('admincardestroy', ['id' => $car->id]));

        // Asserting that the car was deleted from the database
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);

        // Asserting a redirect to the expected route after deletion
        $response->assertRedirect(route('admincarindex'));
        

        // Asserting a session success message
       
    }

    
}
