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
        Schema::create('website_c_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('website_title')->nullable();
            $table->string('top_bar_bg_color')->default(1)->nullable();
            $table->string('top_bar_text_color')->default(1)->nullable();
            $table->string('header_bg_color')->default(1)->nullable();
            $table->string('home_section_bg_color')->nullable();
            $table->string('footer_section_bg_color')->nullable();
            $table->string('contact_form_color')->nullable();
            $table->string('bulk_order_form_color')->nullable();
            $table->string('wholesaler_form_color')->nullable();
            $table->text('loading_image')->nullable();
            $table->tinyInteger('loading_image_status')->default(1)->nullable();
            $table->tinyInteger('slider')->default(1)->nullable();
            $table->tinyInteger('company_logo_header')->default(1)->nullable();
            $table->tinyInteger('company_logo_footer')->default(1)->nullable();
            $table->tinyInteger('footer_social_link')->default(1)->nullable();
            $table->tinyInteger('google_map')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_c_m_s');
    }
};
