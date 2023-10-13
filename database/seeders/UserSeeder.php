<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Admin',
            'email' => 'test@test.com',
            'password' => bcrypt('secret'),
            'center_id' => 2
        ]);
        User::create([
            'name' => 'Soporte',
            'email' => 'icatebcs@gob.mx',
            'password' => bcrypt('secret'),
            'center_id' => 1
        ]);
        User::create([
            'name' => 'Israel Ortega Cordero',
            'email' => 'israel.ortega@icatebcs.gob.mx',
            'password' => bcrypt('Xm5&pVA^5WDfMeCb'),
            
        ]);
        User::create([
            'name' => 'Alicia Bueno Liera',
            'email' => 'alicia.bueno@icatebcs.gob.mx',
            'password' => bcrypt('XT3R48h!F5nFGSMh'),
            
        ]);
        User::create([
            'name' => 'Marisol Díaz Bañedo',
            'email' => 'marisol.diaz@icatebcs.gob.mx',
            'password' => bcrypt('wupgWiWmFhm56G!@'),
            
        ]);
        User::create([
            'name' => 'María Guadalupe Higuera Higuera',
            'email' => 'maria.higuera@icatebcs.gob.mx',
            'password' => bcrypt('^tC3!@^r#aks#Nu3'),
            
        ]);
        User::create([
            'name' => 'Claudia Lisette Rodríguez Delgado',
            'email' => 'claudia.rodriguez@icatebcs.gob.mx',
            'password' => bcrypt('$nPdiR##YfE5ZRBv'),
            
        ]);
        User::create([
            'name' => 'Rosa Imelda Heredia Obeso',
            'email' => 'rosa.heredia@icatebcs.gob.mx',
            'password' => bcrypt('pBfbAnjgGwuC9dK%'),
            
        ]);
    }
}
