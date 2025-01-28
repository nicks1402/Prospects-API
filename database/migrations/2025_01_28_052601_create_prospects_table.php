<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('lead_source'); // e.g., Website, Referral
            $table->string('lead_stage'); // e.g., New, Contacted, Negotiation
            $table->string('assigned_agent');
            $table->string('status'); // e.g., Active, Inactive
            $table->string('property_type'); // e.g., Apartment, Villa
            $table->integer('min_budget');
            $table->integer('max_budget');
            $table->string('location');
            $table->integer('n_bed');
            $table->integer('n_bath');
            $table->string('property_use'); // e.g., Residential, Commercial
            $table->date('last_contact')->nullable();
            $table->date('next_follow')->nullable();
            $table->timestamps();
            $table->text('shortlisted_properties')->nullable(); // JSON for property IDs
            $table->boolean('pre_approved')->default(false);
            $table->date('preferred_move_in_date')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};
