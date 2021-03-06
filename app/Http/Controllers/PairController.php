<?php

namespace App\Http\Controllers;
use App\Pair;

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
            $boys_info = $this->getMemberInfobyId($pair->boys_id);
            $girls_info = $this->getMemberInfobyId($pair->girls_id);
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

        //取得する期間を定義
        $range = collect([
            'start' => $start,
            'end' => $end
        ]);

        //データを成形
        $selected_pairs_collection = collect([
            'selectedInfo' => $selected_pairsBykey_ids,
            'range' => $range
        ]);

        return response()->json([$selected_pairs_collection],200,[],JSON_UNESCAPED_UNICODE);
    }

    public function getAllPairs()
    {
        //取得範囲のpairを取得
        $selected_pairs = DB::table('pairs')
        ->select('boys_id', 'girls_id', 'key_ids', 'count', 'episode_id')
        ->get();

        //該当するメンバー情報を追加して成形
        $selected_pairs = $selected_pairs->map(function ($pair){
            $collection = collect([
                'key_ids' => $pair->key_ids, 
                'count' => $pair->count,
                'episode_id' => $pair->episode_id,
                'boys_id' => $pair->boys_id,
                'girls_id' => $pair->girls_id,
            ]);
            return $collection;
        });

        //key_idsでグループ化
        $selected_pairsBykey_ids = $selected_pairs->groupBy("key_ids");
        
        //各keyでエピソードidごとにデータを成形
        $selected_pairsBykey_ids = $selected_pairsBykey_ids->map(function ($item){
            $CountByEpisode = $item->pluck('count','episode_id');
            $item_first = $item->first();
            $boys_info = $this->getMemberInfobyId($item_first['boys_id']);
            $girls_info = $this->getMemberInfobyId($item_first['girls_id']);
            $arrayByEpisode = collect([
                'CountsByEpisode' => $CountByEpisode,
                'boys_info' => $boys_info[0],
                'girls_info' => $girls_info[0]
            ]);
            return $arrayByEpisode;
        });

        return response()->json([$selected_pairsBykey_ids],200,[],JSON_UNESCAPED_UNICODE);
    }

    //投票された情報から、該当するpairのcountをプラス1
    public function updateCount(Request $request)
    {
        Pair::where("episode_id", request("episode_id"))->where('boys_id', request("boys_id"))->where('girls_id', request("girls_id"))->increment("count");
    }

    public function getMemberInfobyId($id)
    {
        $selected_member = DB::table('members')
        ->where('id', $id)
        ->select('name', 'image_src')
        ->get();
        return $selected_member;
    }

}
