<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms_logs', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ipaddress');
            $table->string('useragent', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('details')->nullable();
            $table->integer('id_cms_users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_logs');
    }
};
