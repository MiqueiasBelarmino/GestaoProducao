<?php

use Illuminate\Database\Seeder;
use app\User;
class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usre::create([
            'fun_nome'      => 'Miquéias Belarmino',
            'email'     => 'miqueias@email.com',
            'password'  => bcrypt('123456'),
        ]);
    }
}
