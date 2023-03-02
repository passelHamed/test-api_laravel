<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    private const TABLE = 'send_posts';

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
                $table->foreignId('subscriber_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                $table->foreignId('post_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
