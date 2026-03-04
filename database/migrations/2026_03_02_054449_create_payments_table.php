<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key relation with users table
            $table->enum('method', ['cash', 'gcash']);  // Payment method
            $table->string('gcash_reference_number')->nullable();  // GCash reference number, nullable
            $table->string('proof_path')->nullable();  // Proof of payment file path, nullable
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');  // Payment status
            $table->timestamp('submitted_at')->nullable();  // Timestamp of payment submission
            $table->timestamps();  // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}