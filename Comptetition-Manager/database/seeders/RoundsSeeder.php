<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoundsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('rounds')->count() == 0) {
            DB::table('rounds')->insert([
                [
                    'id'=>1,
                    'round_name' => 'Jelentkezzetek, és tervezzük újra a jövőt!',
                    'comp_name' => 'Edison Kids',
                    'comp_year' => '2025',
                    'description' => 'Küldjetek nekünk egy max. 2 perces videót, amiben bemutatjátok a csapatot, elmondjátok, hogy melyik kategóriában neveztek (fenntartható jövő, egészség, közösség), valamint elmesélitek, hogy milyen problémára hoztatok ötletet, vagyis megoldási javaslatot és mi az a javaslat.',
                    'questions_number' => '20',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2025-01-16 8:00:00',
                    'round_end' => '2025-02-17 18:00:00',
                ],
                [
                    'id'=>2,
                    'round_name' => 'Találjuk meg együtt a legjobb ötletet!',
                    'comp_name' => 'Edison Kids',
                    'comp_year' => '2025',
                    'description' => 'A kihívásra bejutó 50 csapat, tehát remélhetőleg ti is, a képzés során egy vadonatúj közösségi tanulási platformon fogjátok elsajátítani az új készségeket, miközben lehetőség lesz egymást is megismerni. Ezen időszak alatt 3 online és 1 személyes eseményen vesztek majd részt. A közösségi platformra feltöltött szakmai videókon keresztül felfedezhetitek a jövőtervezés egyik lehetséges módszertanát, a design thinkinget, vagyis a kreatív gondolkodást és a problémamegoldás modern eszközeit. A szakértői videók, a munkafüzetek és az online, élő kérdezz-felelek események és a játékos kvízek révén pedig biztos, hogy mind új megvilágításba tudjátok majd helyezni saját ötleteteket.',
                    'questions_number' => '20',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2025-03-01 8:00:00',
                    'round_end' => '2025-04-07 18:00:00',
                ],
                [
                    'id'=>3,
                    'round_name' => 'Dolgozzuk ki a megoldást!',
                    'comp_name' => 'Edison Kids',
                    'comp_year' => '2025',
                    'description' => 'A továbbjutó 8 csapat – továbbra is bízunk benne, hogy köztük ti is – egy újabb személyes és egy online eseményen vesz részt. Ezen felül további szakmai videókon keresztül kaptok még tőlünk támogatást. Ebben a fázisban a kommunikáción és a pitch felépítésén lesz a hangsúly, hogy felkészítsünk benneteket arra, hogy a kidolgozott ötleteiteket megfelelően tudjátok majd prezentálni a célközönségeteknek és magának a zsűrinek is a döntőn.',
                    'questions_number' => '20',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2025-04-18 8:00:00',
                    'round_end' => '2025-05-27 18:00:00',
                ],
                [
                    'id'=>4,
                    'round_name' => 'Mutassátok be, mire jutottatok!',
                    'comp_name' => 'Edison Kids',
                    'comp_year' => '2025',
                    'description' => 'A kihívást egy személyes prezentáció zárja, ahol a legjobb 8 csapat bemutatja a kidolgozott ötleteket és azok lehetséges megvalósítását a zsűrinek. Végül pedig a nyertes három csapat már tervezheti is, hogy milyen termékekkel gyarapítsa saját, tanára és iskolája eszközparkját, összesen 6 millió forint értékben, a Samsung eszközeiből választva!',
                    'questions_number' => '20',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2025-05-30 8:00:00',
                    'round_end' => '2025-05-30 18:00:00',
                ],
                [
                    'id'=>5,
                    'round_name' => 'Irodalmi Verseny',
                    'comp_name' => 'Arany János',
                    'comp_year' => '2024',
                    'description' => 'A kihívást egy személyes prezentáció zárja, ahol a legjobb 8 csapat bemutatja a kidolgozott ötleteket és azok lehetséges megvalósítását a zsűrinek. Végül pedig a nyertes három csapat már tervezheti is, hogy milyen termékekkel gyarapítsa saját, tanára és iskolája eszközparkját, összesen 6 millió forint értékben, a Samsung eszközeiből választva!',
                    'questions_number' => '20',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2024-12-06 8:00:00',
                    'round_end' => '2024-12-06 18:00:00',
                ],
                [
                    'id'=>6,
                    'round_name' => '1. forduló',
                    'comp_name' => 'Csizmazia Természetismereti Verseny',
                    'comp_year' => '2024',
                    'description' => 'Meglepi',
                    'questions_number' => '30',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2024-03-11 8:00:00',
                    'round_end' => '2024-03-11 18:00:00',
                ],
                [
                    'id'=>7,
                    'round_name' => '2. forduló',
                    'comp_name' => 'Csizmazia Természetismereti Verseny',
                    'comp_year' => '2024',
                    'description' => 'Meglepi',
                    'questions_number' => '30',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2024-03-18 8:00:00',
                    'round_end' => '2024-03-18 18:00:00',
                ],
                [
                    'id'=>8,
                    'round_name' => '3. forduló',
                    'comp_name' => 'Csizmazia Természetismereti Verseny',
                    'comp_year' => '2024',
                    'description' => 'Meglepi',
                    'questions_number' => '30',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2024-03-25 8:00:00',
                    'round_end' => '2024-03-25 18:00:00',
                ],
                [
                    'id'=>9,
                    'round_name' => '4. forduló',
                    'comp_name' => 'Csizmazia Természetismereti Verseny',
                    'comp_year' => '2024',
                    'description' => 'Bolondok napja',
                    'questions_number' => '30',
                    'correct_point' => '5',
                    'wrong_point' => '-3',
                    'blank_point' => '0',
                    'round_start' => '2024-04-01 8:00:00',
                    'round_end' => '2024-04-01 18:00:00',
                ]

            ]);
        }
    }
}
