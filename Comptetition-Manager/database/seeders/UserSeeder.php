<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('users')->count() == 0) {
            DB::table('users')->insert([
                [
                    'email' => 'admin@admin.com',
                    'password' => bcrypt('Admin123'),
                    'first_name' => 'Admin',
                    'last_name' => 'Admin',
                    'birth_date' => '1900-01-01',
                    'address' => 'Admin street 666.',
                    'user_type' => 'Admin'
                ],
                [
                    'email' => 'CsinCsilla@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Csilla',
                    'last_name' => 'Csin',
                    'birth_date' => '2000-04-04',
                    'address' => 'Hegyháthodász Kis Diófa u. 90.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'CicamIca@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Ica',
                    'last_name' => 'Cicam',
                    'birth_date' => '2010-05-12',
                    'address' => 'Abaújlak Baross tér 46.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'ChatElek@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Elek',
                    'last_name' => 'Chat',
                    'birth_date' => '1998-12-12',
                    'address' => 'Karos Hegyalja út 42.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'CeruzaElemer@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Elemér',
                    'last_name' => 'Ceruza',
                    'birth_date' => '1982-06-30',
                    'address' => 'Szeged  Nagytétényi út 97.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'EgrivAron@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Áron',
                    'last_name' => 'Egriv',
                    'birth_date' => '1976-01-01',
                    'address' => 'Kistamási Teréz krt. 79.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'CsakAnyos@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Ányos',
                    'last_name' => 'Csák',
                    'birth_date' => '1988-05-31',
                    'address' => 'Iharos Nánási út 14.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'DiaDora@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Dóra',
                    'last_name' => 'Dia',
                    'birth_date' => '2002-03-03',
                    'address' => 'Sántos Eötvös út 92.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'FolyekonySzilard@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Szilárd',
                    'last_name' => 'Folyékony',
                    'birth_date' => '2001-02-28',
                    'address' => 'Darány Teréz krt. 17.',
                    'user_type' => 'Competitor'
                ],
                [
                    'email' => 'FeherFarkas@gmail.com',
                    'password' => bcrypt('almafa12'),
                    'first_name' => 'Farkas',
                    'last_name' => 'Fehér',
                    'birth_date' => '2000-02-29',
                    'address' => 'Csanádalberti Nagytétényi út 88.',
                    'user_type' => 'Competitor'
                ]
            ]);
        }
    }
}
