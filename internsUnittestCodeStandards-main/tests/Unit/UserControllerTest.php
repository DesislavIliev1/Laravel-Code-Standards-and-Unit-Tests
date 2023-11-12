<?php

namespace Tests\Unit;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\Request;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testIndex()
    {
      $this->withoutMiddleware();

      $response = $this->get(route('adminuserindex'));

      $response->assertStatus(200);
      $response->assertViewIs('users.dashboard');
      

      
    }

    public function testStore(){

        $this->withoutMiddleware();
       
        $request = new Request([
            'name' => 'Mark',
            'email' => 'mark@abv.bg',
            'phone_number' => '34534',
            'password' => '12345678',
          
        ]);
      
        $response = $this->post(route('adminuserstore'), $request ->toArray());
         $response->assertStatus(400);
        
        $this->assertDatabaseHas('users',[
          
            'name' => 'Mark',
            'email' => 'mark@abv.bg',
            'phone_number' => '34534',
          
        ]);
        
    }


    public function testDestroy()
    {

      $this->withoutMiddleware();
        // Creating a test car
        $user = User::factory()->create();

        // Making a DELETE request to the destroy method
        $response = $this->delete(route('adminuserdestroy', ['id' => $user->id]));

        // Asserting that the car was deleted from the database
        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        // Asserting a redirect to the expected route after deletion
        $response->assertRedirect(route('adminuserindex'));
        

        // Asserting a session success message
       
    }
}
