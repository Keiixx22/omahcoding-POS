<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/** Fitur trial dihapus: bisnis berstatus 'trial' menjadi 'active', kolom trial_ends_at dibuang. */
return new class extends Migration {
    public function up(): void
    {
        DB::table('businesses')->where('status', 'trial')->update(['status' => 'active']);

        Schema::table('businesses', function (Blueprint $t) {
            $t->string('status', 20)->default('active')->change();
            $t->dropColumn('trial_ends_at');
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $t) {
            $t->string('status', 20)->default('trial')->change();
            $t->timestamp('trial_ends_at')->nullable();
        });
    }
};
