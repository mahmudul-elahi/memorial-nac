<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFactorColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('two_factor_enabled')->default(false); // Enable/disable 2FA
            $table->string('two_factor_code')->nullable(); // OTP code
            $table->timestamp('two_factor_code_sent_at')->nullable(); // Timestamp when OTP was sent
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['two_factor_enabled', 'two_factor_code', 'two_factor_code_sent_at']);
        });
    }
}
