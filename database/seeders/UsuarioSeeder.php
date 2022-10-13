<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombres' => 'Admin',
            'apellidos' => 'Demo',
            'usuario' => 'Admin',
            'email' => 'sysadmin@admin.com',
            'password' => bcrypt(12345678),
            'tipousuario_id' => '1'
        ]);
    }
}
