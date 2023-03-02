<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'posts';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE)) {
            return;
        }

        Schema::create(
            self::TABLE,
            static function (Blueprint $table) 
            {
                $table->id();
                $table->string("title");
                $table->text("description");
                $table->foreignId("website_id")
                    ->constrained()
                    ->references('id')
                    ->on('websites')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(
            self::TABLE,
        );
    }
};
