<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert(array(
            array(
              'role_code' => '1',
              'role_name' => 'Admin',
            ),
            array(
              'role_code' => '2',
              'role_name' => 'Karyawan',
            ),
        ));
    }
}
