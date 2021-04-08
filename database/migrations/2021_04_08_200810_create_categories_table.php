<?php

use App\Constants\MigrationConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', MigrationConstants::DEFAULT_STRING_LENGTH)->nullable(false);
            $table->string('name_en', MigrationConstants::DEFAULT_STRING_LENGTH)->nullable(false);
            $table->text('description')->nullable(false);
            $table->text('description_en')->nullable(false);
            $table->string('img_url', MigrationConstants::DEFAULT_STRING_LENGTH)->nullable(false);
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
        Schema::dropIfExists('categories');
    }
}
