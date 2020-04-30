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
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/kenny.png',
            ],
            [
                'name' => '松㟢翔平',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/shohei.jpg',
            ],
            [
                'name' => '西野入流佳',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/ruka.png',
            ],
            [
                'name' => '渡邉香織',
                'sex' => 2,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/kaori.jpg',
            ],
            [
                'name' => '田辺莉咲子',
                'sex' => 2,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/risako.jpg',
            ],
            [
                'name' => '奥山春花',
                'sex' => 2,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/haruka.png',
            ],
            [
                'name' => 'デュラト・ジュゼッペ',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/peppe.png',
            ],
            [
                'name' => '田渡凌',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/ryo.jpg',
            ],
            [
                'name' => '水越愛華',
                'sex' => 2,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/emika.png',
            ],
            [
                'name' => 'トパス・ジョンキンバルー',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/topasu.jpeg',
            ],
            [
                'name' => '木村花',
                'sex' => 2,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/hana.jpeg',
            ],
            [
                'name' => '小林快',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/kai.jpg',
            ],
            [
                'name' => 'ラズドゥミナ・ヴィオレッタ',
                'sex' => 2,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/vivi.jpg',
            ],
            [
                'name' => '新野俊幸',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/syacyou.jpg',
            ],
            [
                'name' => '吉田夢',
                'sex' => 2,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/yume.jpg',
            ],
            [
                'name' => '鈴木志遠',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/sionn.jpg',
            ],
            [
                'name' => '金尾玲生',
                'sex' => 1,
                'image_src' => 'https://teraehamania.s3-ap-northeast-1.amazonaws.com/TOKYO/member/reo.png',
            ],
        ]);
    }
}
