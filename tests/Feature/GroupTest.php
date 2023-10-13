<?php

namespace Tests\Feature;

use App\Helpers\AppHelpers;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
/*     public function test_store()
    {

        // correr esta prueba : php artisan test --filter GroupTest
        $response = $this->post('/group', [
            'center_id' => 2,
            'course_id' => 1,
            'instructor_id' => 1,
            'place_id' => 1,
            'date_start' => now(),
            'date_end' => Carbon::now()->addMonth(),
            'time_start' => now(),
            'time_end' => Carbon::now()->addHours(4),
            'students' => [21402,21403,21413]
        ]);

        error_log($response->getContent());
        $response->assertStatus(200);
        $this->assertTrue(true);
    } */

/*     public function test_index(){
        $response =$this->get('group');
        error_log(AppHelpers::prettyPrint($response->getContent()));
        // error_log($response->getContent());
        $response->assertStatus(200);
        $this->assertTrue(true);
    }  */


 /*    public function test_create(){
        $response = $this->get('/group/create');
        error_log($response->getContent());
        $response->assertStatus(200);
        $this->assertTrue(true);
    } */
  public function test_get(){
        $id = Group::select('id')->pluck('id')->random();
        $response = $this->get("group/$id");
      error_log(AppHelpers::prettyPrint($response->getContent()));
         // error_log(($response->getContent()));
        $response->assertStatus(200);
    } 
    
   /*   public function test_update(){
        
        // $request = new GroupRequest();
        $response =  $this->put('group',
    
        [
            // https://http.cat/[status_code]
            'group_id' => 1, // no deberia cambiar, permite identificar el registro a editar 
            'center_id' => 1, // no deberia cambiar, todo (estudiantes, lugares, instructores, lugares) depende de el centro 
            'course_id' => 2, 
            'instructor_id' => 1,
            'place_id' => 1,
            'date_start' => now(),
            'date_end' => Carbon::now()->addMonth(),
            'time_start' => now(),
            'time_end' => Carbon::now()->addHours(4),
            'students' => [21402,21403]
        ]
    
    
    
    );
        error_log(($response->getContent()));
        
        $response->assertStatus(200);

    }  */
}
