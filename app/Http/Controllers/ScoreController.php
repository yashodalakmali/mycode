<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function getScorebyCountry(Request $request){



        $query = $request->input("queryResult");
        $params = $query["parameters"];
        $team = $params["Team"];

        $score = Score::where('batting',$team)->latest()->get();

        $batting_team = $team;
        $bowling_team = $score[0]->bowling;
        $runs = $score[0]->score;
        $wkts = $score[0]->wkts;
        $overs = $score[0]->overs;
        $target = $score[0]->target;

        $message = $batting_team." is ".$runs." runs for ".$wkts." wickets in ".$overs." overs, against the ".$bowling_team." and needs more ".$target." runs to win.";

        return response()->json(['fulfillmentText'=>$message]);
    }
}
