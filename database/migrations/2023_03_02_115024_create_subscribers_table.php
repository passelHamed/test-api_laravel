<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    private const TABLE = 'subscribers';

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
                $table->string('email');
                $table->foreignId('website_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
