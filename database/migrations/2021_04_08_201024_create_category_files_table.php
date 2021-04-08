<?php

use App\Constants\MigrationConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('path', MigrationConstants::DEFAULT_STRING_LENGTH)->nullable(false);
            $table->string('file_extension', MigrationConstants::DEFAULT_FILE_EXTENSION_LENGTH)->nullable();
            $table->enum('type', [
                MigrationConstants::ENUM_PDF,
                MigrationConstants::ENUM_IMG
            ])->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_files');
    }
}
