<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_send_message()
    {
        // Create two users
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        // Act as sender
        $response = $this->actingAs($sender)->postJson('/chat/send', [
            'to_id' => $receiver->id_user,
            'message' => 'Hello, this is a test message.',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['status', 'data' => ['id', 'from_id', 'to_id', 'message', 'created_at', 'updated_at']]);

        // Assert message is stored in database
        $this->assertDatabaseHas('messages', [
            'from_id' => $sender->id_user,
            'to_id' => $receiver->id_user,
            'message' => 'Hello, this is a test message.',
        ]);
    }

    public function test_message_send_validation()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/chat/send', [
            'to_id' => null,
            'message' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['to_id', 'message']);
    }

    public function test_guest_cannot_send_message()
    {
        $response = $this->postJson('/chat/send', [
            'to_id' => 1,
            'message' => 'Test message',
        ]);

        $response->assertStatus(401);
    }
}
