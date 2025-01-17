<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('competitions')->count() == 0) {
            DB::table('competitions')->insert([
                [
                    'comp_name' => 'Edison Kids',
                    'comp_year' => '2025',
                    'prize' => 1200000,
                    'description' => 'Mi már megújultunk, és most rajtatok a sor! Akár jelentkeztetek már korábban, akár ez lesz nálunk az első versenyeteket, mutassátok meg, hogy mi a ti saját, izgalmas utatok a jövőtervezésben.',
                    'address' => 'Sárrétudvari Tompa u. 59.',
                    'comp_start' => '2025-01-16',
                    'comp_end' => '2025-05-30',
                    'languages' => 'Magyar, Angol',
                    'comp_limit' => 50,
                    'entry_fee' => 0,
                ],
                [
                    'comp_name' => 'Arany János',
                    'comp_year' => '2024',
                    'prize' => 0,
                    'description' => 'Az olvasottság, az irodalomismeret szélesítése és elmélyítése, az élményszerű befogadás és műértés fejlesztése, az ezekről való írásbeli és szóbeli megnyilatkozások színvonalának emelése, mindezek kapcsán a tantárgyi képességek és a tájékozottság növelése, értékelése. Célunk továbbá a magyar irodalom tantárgyban kiemelkedő teljesítményre képes tanulók számára versenylehetőség teremtése, a tehetség gondozása.',
                    'address' => 'Sárrétudvari Tompa u. 59.',
                    'comp_start' => '2024-10-25',
                    'comp_end' => '2025-01-12',
                    'languages' => 'Magyar, Angol',
                    'comp_limit' => 50,
                    'entry_fee' => 0,
                ],
                [
                    'comp_name' => 'Csizmazia Természetismereti Verseny',
                    'comp_year' => '2024',
                    'prize' => 0,
                    'description' => 'A Csizmazia Magánalapítvány internetes természetismereti versenyt hirdet 5-10 évfolyamos tanulók számára. A négy fordulóból álló verseny 2024. március 11-én indul, minden héten hétfőn új feladatsorral jelentkezik, amelyet online kell kitölteni. A megnyíló feladatsor a verseny végéig bármikor kitölthető.',
                    'address' => 'Sárrétudvari Tompa u. 59.',
                    'comp_start' => '2024-03-11',
                    'comp_end' => '2025-04-01',
                    'languages' => 'Magyar, Angol',
                    'comp_limit' => 300,
                    'entry_fee' => 0,
                ],
            ]);
        }
    }
}
