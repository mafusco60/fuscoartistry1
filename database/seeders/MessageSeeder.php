<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $message=Message::create([
            'body' => 'Hello World',
            'sender_id' => 1,
            'artwork_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),

            'name' => 'Test User',
            'email' => 'test@test.com',
            'phone' => '1234567890',
            'subject' => 'Upload File',
            'image' => '/uploads/ballerina.jpg',
            
       ]);
       return $message;
    }
}
