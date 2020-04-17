<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            [
                'name' => '吉原健司',
                'sex' => 1,
            ],
            [
                'name' => '松㟢翔平',
                'sex' => 1,
            ],
            [
                'name' => '西野入流佳',
                'sex' => 1,
            ],
            [
                'name' => '渡邉香織',
                'sex' => 2,
            ],
            [
                'name' => '田辺莉咲子',
                'sex' => 2,
            ],
            [
                'name' => '奥山春花',
                'sex' => 2,
            ],
            [
                'name' => 'デュラト・ジュゼッペ',
                'sex' => 1,
            ],
            [
                'name' => '田渡凌',
                'sex' => 1,
            ],
            [
                'name' => '水越愛華',
                'sex' => 2,
            ],
            [
                'name' => 'トパス・ジョンキンバルー',
                'sex' => 1,
            ],
            [
                'name' => '木村花',
                'sex' => 2,
            ],
            [
                'name' => '小林快',
                'sex' => 1,
            ],
            [
                'name' => 'ラズドゥミナ・ヴィオレッタ',
                'sex' => 2,
            ],
            [
                'name' => '新野俊幸',
                'sex' => 1,
            ],
            [
                'name' => '吉田夢',
                'sex' => 2,
            ],
            [
                'name' => '鈴木志遠',
                'sex' => 1,
            ],
            [
                'name' => '金尾玲生',
                'sex' => 1,
            ],
        ]);
    }
}
