<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContributionType;

class ContributionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contributionTypes = [
            [
                'name' => 'mchango wa mwezi',
                'goal' => 'Kuchangia mfuko wa vijana kwa lengo la kuongeza salio la mfuko.',
                'identifier' => 'mwezi',
                'goal_amount' => 1500.00,
            ],
            [
                'name' => 'sadaka ya ujenzi',
                'goal' => 'Kuchangia ujenzi wa kanisa jipya au ukarabati wa majengo ya kanisa.',
                'identifier' => 'ujenzikanisa',
                'goal_amount' => 10000.00,
            ],
            [
                'name' => 'sadaka ya shukrani',
                'goal' => 'Sadaka ya shukrani kwa baraka na mafanikio yaliyopatikana.',
                'identifier' => 'shukrani',
                'goal_amount' => 300000.00,
            ],
            [
                'name' => 'sadaka ya misa ya marehemu',
                'goal' => 'Kuchangia misa maalum ya kuwaombea marehemu.',
                'identifier' => 'misamarehemu',
                'goal_amount' => 100000.00,
            ],
            [
                'name' => 'sadaka ya matendo ya huruma',
                'goal' => 'Kusaidia huduma za kijamii kama vile kusaidia yatima, wagonjwa, na wenye uhitaji.',
                'identifier' => 'matendohuruma',
                'goal_amount' => 700000.00,
            ],
            [
                'name' => 'sadaka ya vijana',
                'goal' => 'Kuchangia miradi na shughuli za maendeleo ya vijana katika kanisa.',
                'identifier' => 'maendeleovijana',
                'goal_amount' => 400000.00,
            ],
            [
                'name' => 'sadaka ya wanawake',
                'goal' => 'Kuchangia miradi na shughuli za maendeleo ya wanawake katika kanisa.',
                'identifier' => 'maendeleowanawake',
                'goal_amount' => 350000.00,
            ],
            [
                'name' => 'sadaka ya wazee',
                'goal' => 'Kuchangia miradi na huduma za wazee katika kanisa.',
                'identifier' => 'maendeleowazee',
                'goal_amount' => 250000.00,
            ],
            [
                'name' => 'sadaka ya mkutano',
                'goal' => 'Kuchangia gharama za mkutano au kongamano maalum la kanisa.',
                'identifier' => 'kongamano',
                'goal_amount' => 600000.00,
            ],
            [
                'name' => 'sadaka ya matengenezo',
                'goal' => 'Kusaidia matengenezo na ukarabati wa vifaa na miundombinu ya kanisa.',
                'identifier' => 'matengenezo',
                'goal_amount' => 800000.00,
            ],
        ];

        foreach ($contributionTypes as $type) {
            ContributionType::create($type);
        }
    }
}
