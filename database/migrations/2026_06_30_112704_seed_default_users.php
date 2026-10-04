<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Buat akun default admin dan member.
     */
    public function up(): void
    {
        $now = now();

        $users = [
            [
                'name'              => 'Administrator',
                'email'             => 'admin@example.com',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'Member User',
                'email'             => 'member@example.com',
                'password'          => Hash::make('password'),
                'role'              => 'member',
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        foreach ($users as $user) {
            // Cek dulu agar tidak duplikat jika migrate dijalankan ulang
            if (! DB::table('users')->where('email', $user['email'])->exists()) {
                DB::table('users')->insert($user);
            }
        }
    }

    /**
     * Hapus akun default saat rollback.
     */
    public function down(): void
    {
        DB::table('users')->whereIn('email', [
            'admin@example.com',
            'member@example.com',
        ])->delete();
    }
};
