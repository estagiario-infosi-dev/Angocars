<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'user@infosi.com'],
            [
                'name' => 'Usuário Padrão',
                'password' => Hash::make('user123'),
                'role' => 'employee',
               
            ]
        );

        $this->command->info('Usuário comum criado com sucesso.');
    }
}
