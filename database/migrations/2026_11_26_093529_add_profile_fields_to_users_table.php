<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('role')->default('user')->after('password');      // admin / user
            $table->string('status')->default('aktif')->after('role');       // aktif / nonaktif
            $table->string('phone', 20)->nullable();
            $table->string('jabatan')->nullable();
            $table->string('instansi')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamp('last_login_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username','role','status','phone','jabatan','instansi','alamat','last_login_at']);
        });
    }
};