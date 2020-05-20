<?php

namespace App\Http\Controllers;
use App\Member;


use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function getMemberbyId(Request $request)
    {
        $getMember = Member::find($request->id);
        return response()->json(['member' => $getMember],200,[],JSON_UNESCAPED_UNICODE);
    }
}
