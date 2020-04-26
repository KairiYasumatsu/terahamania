<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PairController extends Controller
{
    public function getLatestPair()
    {
        //最新のエピソードを取得
        $episode = DB::table('episodes')
        ->orderBy('number', 'DESC')
        ->take(5)
        ->get()
        ->pluck('number');

        //取得範囲を定義
        $start = $episode->last();
        $end = $episode->first();

        //取得範囲のpairを取得
        $selected_pairs = DB::table('pairs')
        ->whereBetween('episode_id', [$start,$end])
        ->select('boys_id', 'girls_id', 'key_ids', 'count', 'episode_id')
        ->get();

        //該当するメンバー情報を追加して成形
        $selected_pairs = $selected_pairs->map(function ($pair){
            $boys_info = $this->getMemberNamebyId($pair->boys_id);
            $girls_info = $this->getMemberNamebyId($pair->girls_id);
            $collection = collect([
                'key_ids' => $pair->key_ids, 
                'count' => $pair->count,
                'episode_id' => $pair->episode_id,
                'boys_id' => $pair->boys_id,
                'boys_info' => $boys_info,
                'girls_id' => $pair->girls_id,
                'girls_info' => $girls_info
            ]);
            return $collection;
        });

        //key_idsでグループ化
        $selected_pairsBykey_ids = $selected_pairs->groupBy("key_ids");

        return response()->json([$selected_pairsBykey_ids],200,[],JSON_UNESCAPED_UNICODE);
    }

    public function getMemberNamebyId($id)
    {
        $selected_member = DB::table('members')
        ->where('id', $id)
        ->select('name')
        ->get();
        return $selected_member;
    }

}
