<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Personal info
            $table->string('first_name')->after('id');
            $table->string('surname')->after('first_name');
            $table->string('middle_initial', 10)->nullable()->after('surname');
            $table->string('home_address')->after('email');

            // School info
            $table->string('school_name')->nullable()->after('home_address');
            $table->string('year_level')->nullable()->after('school_name');
            $table->string('school_year')->nullable()->after('year_level');
            $table->unsignedInteger('required_hours')->nullable()->after('school_year');

            // Uploaded documents (store file paths)
            $table->string('moa_path')->nullable()->after('required_hours');        // optional
            $table->string('school_id_path')->nullable()->after('moa_path');       // required in form, but keep nullable in DB

            // Account control
            $table->enum('role', ['admin', 'member'])->default('member')->after('school_id_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('role');
            $table->timestamp('approved_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'surname',
                'middle_initial',
                'home_address',
                'school_name',
                'year_level',
                'school_year',
                'required_hours',
                'moa_path',
                'school_id_path',
                'role',
                'status',
                'approved_at',
            ]);
        });
    }
};