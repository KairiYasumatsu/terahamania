<?php

namespace App\Http\Controllers;

use App\Member;
use App\Pair;
use App\Episode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index()
    {
        $episodes = Episode::all();
        return view('episodes.index',[
            'episodes' => $episodes
        ]);
    }

    public function show(Episode $episode)
    {
        $men_member = Episode::find($episode->number)->members->where('sex', 1);
        $boys = array();
        foreach ($men_member as $member) {
            $memberinfo = $this->getMemberbyId($member->id);
            array_push($boys, $memberinfo);
        }

        $women_member = Episode::find($episode->number)->members->where('sex', 2);
        $girls = array();
        foreach ($women_member as $member) {
            $memberinfo = $this->getMemberbyId($member->id);
            array_push($girls, $memberinfo);
        }

        return view("episodes.show", ["episode" => $episode, "boys" => $boys, "girls" => $girls]);
    }

    public function store(Episode $episode)
    {
        Pair::where("episode_id", request("episode_id"))->where('boys_id', request("boys_id"))->where('girls_id', request("girls_id"))->increment("count");    
        return redirect(route('episode.index'));
    }

    public function getMemberbyId($id)
    {
        $selected_member = Member::find($id);
        return $selected_member;
    }

    public function getMemberbyEpisode(Request $request)
    {
        $men_member = Episode::find($request->id)->members->where('sex', 1);
        $boys = array();
        foreach ($men_member as $member) {
            $memberinfo = $this->getMemberbyId($member->id);
            array_push($boys, $memberinfo);
        }

        $women_member = Episode::find($request->id)->members->where('sex', 2);
        $girls = array();
        foreach ($women_member as $member) {
            $memberinfo = $this->getMemberbyId($member->id);
            array_push($girls, $memberinfo);
        }
        return response()->json(['boys' => $boys, 'girls' => $girls],200,[],JSON_UNESCAPED_UNICODE);    
    }
}
