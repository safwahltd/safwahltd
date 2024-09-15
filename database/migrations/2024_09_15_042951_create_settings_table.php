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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_title')->nullable();
            $table->string('phone')->nullable();
            $table->string('hotLine')->unique();
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->text('map')->nullable();
            $table->text('website_link')->nullable();
            $table->text('app_link')->nullable();
            $table->text('ios_link')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('mail_mailer')->nullable();
            $table->text('mail_host')->nullable();
            $table->integer('mail_port')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
