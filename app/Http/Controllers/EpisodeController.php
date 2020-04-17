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

    public function store()
    {
        $pair = Pair::where('boys_id', request("boys_id"))->where('girls_id', request("girls_id"))->exists();
        if ($pair) {
            Pair::where('boys_id', request("boys_id"))->where('girls_id', request("girls_id"))->increment("count");    
        } else {
            $newPair = new Pair(request(['boys_id', 'girls_id']));
            $newPair->count = 1;
            $newPair->save();  
        }

        return redirect(route('episode.index'));
    }

    public function getMemberbyId($id)
    {
        $selected_member = Member::find($id);
        return $selected_member;
    }
}
