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
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->after('email_verified_at'); // chỉ định vị trí nếu cần
            $table->integer('role_id')->after('dob');
            $table->tinyInteger('status')->after('role_id');
            $table->string('address', 500)->after('status');
            $table->tinyInteger('isConfirmed')->default(0)->after('address');
            $table->string('captcha', 50)->after('isConfirmed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'dob',
                'role_id',
                'status',
                'address',
                'isConfirmed',
                'captcha'
            ]);
        });
    }
};
