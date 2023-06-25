<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\FrontpageConfiguration;
use App\Models\Component;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private function testComponents()
    {


        $imageUrls = [
            '/assets/configuration_thumbnails/dawn/2seater/44.jpg',
            '/assets/configuration_thumbnails/dawn/2seater/44.jpg',
            // Add more image URLs as needed
        ];
        foreach ($imageUrls as $url) {
            $frontpageConfiguration = new FrontpageConfiguration();
            $frontpageConfiguration->url = $url;
            $frontpageConfiguration->identifier = "test";
            $frontpageConfiguration->size = "2seater";
            $frontpageConfiguration->type = "type";
            $frontpageConfiguration->save();
        }
    }


    private function seedComponents(string $type, array $folders, array $prices)
    {
        foreach ($folders as $key => $folder) {
            $folderPath = public_path('assets/' . $type . '/' . $folder);
            $filesInFolder = File::files($folderPath);

            foreach ($filesInFolder as $file) {
                $fileName = basename($file);
                $filePath = asset(str_replace('\\', '/', $file));

                $component = new Component();
                $component->url = $filePath;
                $component->category = $folder;
                $component->file_name = $fileName;
                $component->price = $prices[$key];
                $component->type = $type;
                $component->save();
            }
        }
    }



    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test2 User2',
            'email' => 'test2@example2.com',
        ]);
    }
}
