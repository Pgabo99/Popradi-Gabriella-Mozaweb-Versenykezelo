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
    /**
     * Returns the data from the Competitors table
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     *  Redirects to the Rounds page
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $rounds = Rounds::all();

        $users = User::get();
        return view("competitors.create", ['rounds' => $rounds, 'users' => $users]);
    }

    /**
     * reates/Updates a Competitor 
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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

    /**
     * Returns the editable data, if it exists
     * @param mixed $user_email
     * @param mixed $round_id
     * @return TModel
     */
    public function edit($user_email, $round_id)
    {
        $competitor = Competitors::where('user_email', $user_email)->where('round_id', $round_id)->first();
        if (!$competitor) {
            abort(404);
        }
        return $competitor;
    }
    /**
     * Deletes the data, if it exists
     * @param \Illuminate\Http\Request $request
     * @param mixed $user_email
     * @param mixed $round_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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

    public function userStore(Request $request, $round_id, )
    {
        if (!Competitors::where('user_email', auth()->user()->email)->where('round_id', $round_id)->first()) {
            $data = array(
                'user_email' => auth()->user()->email,
                'round_id' => $round_id,
                'points' => 0,
                'placement' => 0,
                'correct_answ' => 0,
                'wrong_answ' => 0,
                'blank_answ' => 0
            );
            if (Competitors::create($data)) {
                return response()->json([
                    'success' => 'Sikeres verseny felvétel'
                ], 201);
            }
        }
        return response()->json([
            'error' => 'Erre már jelentkeztél'
        ], 404);
    }
}
