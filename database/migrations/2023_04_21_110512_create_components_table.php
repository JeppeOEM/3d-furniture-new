<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\DatabaseSeeder;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * 
     * 
     */

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



    public function up(): void
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('url');
            $table->text('category');
            $table->text('type')->default('dawn');
            $table->text('file_name');
            $table->text('thumbnail_url')->nullable();
            $table->float('price');
        });

        // Component::create([
        //     'url' => "url",
        //     'category' => "1_SEATER",
        //     'type' => "dawn",
        //     'thumpnail' => "dawn",
        //     'file_name' => "BLACK_177_OLENA_LIGHT_GREY.glb",
        //     'price' => "900",
        // ]);

        $type = "dawn";
        $folders = ['1_SEATER', 'CHAISE_LEFT', 'CHAISE_RIGHT', 'CORNER'];
        $prices = [4500, 9000, 9000, 5500, 5500];
        $this->seedComponents($type, $folders, $prices);

        $type = "dusk";
        $folders = ['1_SEATER', '1_SEATER_BIG', '2_SEATER', 'CHAISE_RIGHT', 'CORNER', 'CORNER_LEFT', 'CORNER_LEFT_BIG'];
        $prices = [4500, 6000, 7800, 11000, 5500, 5500, 7900];
        $this->seedComponents($type, $folders, $prices);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
