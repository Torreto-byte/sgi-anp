<?php

namespace App\Http\Controllers\AgentCourrier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardAgentCourrierController extends Controller
{
    public function index()
    {
        $nbrLetterIns = DB::table('letters_ins')->whereNull('delete_at')->whereDate('date_add', Carbon::now()) ->get();

        $nbrLetterOutDay = DB::table('letters_outs')->whereNull('delete_at')->whereDate('created_at', Carbon::now()) ->get();

        $nbrLetterNotImput = DB::table('letters_ins')->whereNull('code_instruction')->get();

        $nbrLetterNotDecharg = DB::table('imputations')
                                ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                                ->whereNull('date_reception')
                                ->get();

        $nbrLetterNotRep = DB::table('letters_ins')->where('code_instruction', 'repondre')->whereNull('etat')->get();

        $getActivity = DB::table('user_histories')
                        ->where('user_id', Auth::user()->id)
                        ->orderByDesc('created_at')
                        ->limit(25)
                        ->get();

        $items  = DB::table('imputations')
                ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                ->leftJoin('directions', 'directions.id', '=', 'imputations.direction_id')
                ->select('letters_ins.*', 'chrono_ins.numero', 'directions.sigle')
                ->whereNull('delete_at')
                ->whereNull('etat')
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();


        $itemsOut =  DB::table('letters_outs')
                ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
                ->select('letters_outs.*', 'chrono_outs.numero')
                ->whereNull('delete_at')
                ->whereNull('etat')
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();


        return view('service-courrier.home', compact('items',
            'getActivity',
            'nbrLetterIns',
            'nbrLetterNotImput',
            'nbrLetterNotRep',
            'nbrLetterOutDay',
            'nbrLetterNotDecharg',
            'itemsOut'
        ));
    }
}
