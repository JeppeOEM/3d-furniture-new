<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use App\Models\FrontpageConfiguration;

return new class extends Migration
{


    private function seedFrontpageConfigurations(array $folders)
    {
        foreach ($folders as $key => $folder) {
            $folderPath = public_path('assets/configuration_thumbnails/dusk/' . $folder);
            // $folderPath = public_path('assets/configuration_thumbnails/' . $type . '/' . $folder);
            $filesInFolder = File::files($folderPath);

            foreach ($filesInFolder as $file) {
                $fileName = basename($file);
                $filePath = asset(str_replace('\\', '/', $file->getPathname()));

                $frontpageConfiguration = new FrontpageConfiguration();
                $frontpageConfiguration->url = $filePath;
                $frontpageConfiguration->identifier = $fileName;
                $frontpageConfiguration->size = $folder;
                $frontpageConfiguration->type = "dusk";
                $frontpageConfiguration->save();
            }
        }
    }


    public function up(): void
    {
        Schema::create('frontpage_configurations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('url')->nullable();
            $table->text('identifier')->nullable();
            $table->text('size')->nullable();
            $table->text('type')->nullable();
        });



        // $type = "dawn";
        // $folders = ['2seater', '3seater', 'corner'];
        // $this->seedFrontpageConfigurations($folders, $type);

        // $type = "dusk";
        $folders = ['2seater', '3seater', 'corner'];
        $this->seedFrontpageConfigurations($folders);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frontpage_configurations');
    }
};
