<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Video;

class VideoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRetrievingSize()
    {
		
		$user=User::where('id', rand(1, 10))->first();
		
        $response = $this->get('api/user/' . $user->username . '/size/');

        $response
			->assertStatus(200);
				
    }
	
	public function testRetrievingEndPointMetaData()
    {
		
        $response = $this->get('api/video/'.rand(1,100));
		
		$response
			->assertJsonCount(3)
			->assertStatus(200);
			
    }
	
	public function testUpdatingSizeViewerCountVideoID()
    {
		
		$video_id=rand(1,100);
		$old_video=$this->get('api/video/'.$video_id);
		
		$data = [ 'VideoID' => $video_id, 'Size' => rand(0,1000000), 'ViewerCount' => rand(0,10000) ];
	
        $response = $this->patch('api/video', $data);
		$response->assertStatus(200);
		
		$new_video=$this->get('api/video/'.$video_id);
		
		$this->assertNotEquals($new_video, $old_video);	
    }
}
