<?php

namespace App\Http\Controllers;

use App\Models\Competitors;
use App\Models\Rounds;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Competitions;
use Illuminate\Support\Facades\DB;

class CompetitorsController extends Controller
{
    public function index(Request $request)
    {
        $competitors = Competitors::select('user_email', 'round_id', 'points', 'placement', 'correct_answ', 'wrong_answ', 'blank_answ');
        if ($request->ajax()) {
            return DataTables::of($competitors)->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="btn-sm btn btn-secondary editButton d-grid gap-2" data-user_email="' . $row->user_email . '" data-round_id="' . $row->round_id . '">Szerkeszt</a>
                <a href="javascript:void(0)" class="btn-sm btn btn-danger deleteButton d-grid gap-2" data-user_email="' . $row->user_email . '" data-round_id="' . $row->round_id . '">Töröl</a>';
            })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function create()
    {
        $rounds = Rounds::all();
        
        $users  =  User::get();
        return view("competitors.create",['rounds'=>$rounds,'users'=>$users]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_email' => 'required|email',
            'round_id' => 'required|numeric',
            'points' => 'numeric',
            'placement' => 'numeric',
            'correct_answ' => 'required|numeric',
            'wrong_answ' => 'required|numeric',
            'blank_answ' => 'required|numeric',

        ]);

        if ($request->comp_edit != null) {
            $competitor = Competitors::where('user_email', $data['user_email'])->where('round_id', $data['round_id'])->first();
            if (!$competitor) {
                abort(404);
            }
            $competitor->update([
                'points' => $data['points'],
                'placement' => $data['placement'],
                'correct_answ' => $data['correct_answ'],
                'wrong_answ' => $data['wrong_answ'],
                'blank_answ' => $data['blank_answ']
            ]);
            return response()->json([
                'success' => 'Sikeres módosítás!'
            ], 201);

        } else {
            if (Competitors::create($data)) {
                return response()->json([
                    'success' => 'Sikeres verseny felvétel'
                ], 201);
            }
        }
    }

    public function edit($user_email, $round_id)
    {
        $competitor = Competitors::where('user_email', $user_email)->where('round_id', $round_id)->first();
        if (!$competitor) {
            abort(404);
        }
        return $competitor;
    }

    public function destroy(Request $request, $user_email, $round_id)
    {
        $competitor = Competitors::where('user_email', $user_email)->where('round_id', $round_id)->first();
        if (!$competitor) {
            abort(404);
        }
        $competitor->delete();
        return response()->json([
            'success' => 'Sikeres törlés!'
        ], 201);
    }
}
