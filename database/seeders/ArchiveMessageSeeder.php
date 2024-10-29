<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArchiveMessage;

class ArchiveMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $archive_message=ArchiveMessage::create([
            'archive_body' => 'Hello Artist! I am interested in purchasing your artwork.,How much do you charge for a commisioned original? I would like to know more about your process.,I am interested in purchasing your artwork.,I would like to know more about your process.,I am interested in purchasing your artwork.,I would like to know more about your process.,I am interested in purchasing your artwork.,I would like to know more about your process.,I am interested in purchasing your artwork.,I would like to know more about your process.,I am interested in purchasing your artwork',          
            
            'archive_sender_id' => 1,
            'archive_listing_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
            'original_creation_date' => now(),
            'archive_name' => 'Test User',
            'archive_email' => 'test@test.com',
            // 'archive_phone' => '1234567890',
            'archive_subject' => 'Upload File',
            'archive_upload' => '/uploads/ballerina.jpg',
            
       ]);
       return $archive_message;
    }
}
