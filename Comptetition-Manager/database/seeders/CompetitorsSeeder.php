<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('competitors')->count() == 0){
            DB::table('competitors')->insert([
                [
                    'user_email' => 'FolyekonySzilard@gmail.com',
                    'round_id' => 1,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'FolyekonySzilard@gmail.com',
                    'round_id' => 2,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'FolyekonySzilard@gmail.com',
                    'round_id' => 3,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'FolyekonySzilard@gmail.com',
                    'round_id' => 4,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'CsinCsilla@gmail.com',
                    'round_id' => 1,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'CsinCsilla@gmail.com',
                    'round_id' => 2,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'CsinCsilla@gmail.com',
                    'round_id' => 3,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'CsinCsilla@gmail.com',
                    'round_id' => 4,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'CicamIca@gmail.com',
                    'round_id' => 1,
                    'points' => 0,
                    'placement' => 0,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'CicamIca@gmail.com',
                    'round_id' => 5,
                    'points' => 100,
                    'placement' => 1,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'CsinCsilla@gmail.com',
                    'round_id' => 5,
                    'points' => 30,
                    'placement' => 3,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                [
                    'user_email' => 'FolyekonySzilard@gmail.com',
                    'round_id' => 5,
                    'points' => 50,
                    'placement' => 2,
                    'correct_answ' => 0,
                    'wrong_answ' => 0,
                    'blank_answ' => 0
                ],
                
            ]);
        }
    }
}
