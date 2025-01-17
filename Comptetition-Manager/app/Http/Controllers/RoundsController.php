<?php

namespace App\Http\Controllers;

use App\Models\Competitions;
use App\Models\Competitors;
use App\Models\Rounds;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoundsController extends Controller
{
    /**
     * Returns the data from the Rounds table
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $rounds = Rounds::select('id', 'round_name', 'comp_name', 'comp_year', 'description', 'questions_number', 'round_start', 'round_end', 'correct_point', 'wrong_point', 'blank_point');
        if ($request->ajax()) {
            return DataTables::of($rounds)->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="btn-sm btn btn-secondary editButton d-grid gap-2" data-id="' . $row->id . '" >Szerkeszt</a>
                <a href="javascript:void(0)" class="btn-sm btn btn-danger deleteButton d-grid gap-2" data-id="' . $row->id . '">Töröl</a>';
            })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Redirects to the Rounds page
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $competitions = Competitions::all();
        $compString = [];
        foreach ($competitions as $competition) {
            $compString[] = $competition['comp_name'] . ' - ' . $competition['comp_year'];
        }

        return view("rounds.create", ['compString' => $compString]);
    }

    /**
     * Creates/Updates a Round
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'round_name' => 'required|string|max:255',
            'competition' => 'required',
            'description' => 'string',
            'questions_number' => 'required|numeric',
            'correct_point' => 'required|numeric',
            'wrong_point' => 'required|numeric',
            'blank_point' => 'required|numeric',
            'round_start' => 'required|date',
            'round_end' => 'required|date',
        ]);

        $data['comp_name'] = explode(' - ', $data['competition'])[0];
        $data['comp_year'] = explode(' - ', $data['competition'])[1];
        unset($data['competition']);

        if ($request->round_edit != null) {
            $round = Rounds::find($request->round_edit);
            if (!$round) {
                abort(404);
            }
            $round->update([
                'round_name' => $data['round_name'],
                'comp_name' => $data['comp_name'],
                'comp_year' => $data['comp_year'],
                'description' => $data['description'],
                'round_start' => $data['round_start'],
                'round_end' => $data['round_end'],
                'questions_number' => $data['questions_number'],
                'correct_point' => $data['correct_point'],
                'wrong_point' => $data['wrong_point'],
                'blank_point' => $data['blank_point']
            ]);
            return response()->json([
                'success' => 'Sikeres módosítás!'
            ], 201);

        } else {
            if (Rounds::create($data)) {
                return response()->json([
                    'success' => 'Sikeres forduló felvétele'
                ], 201);
            }
        }

    }

    /**
     * Returns the editable data, if it exists
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function edit($id)
    {
        $round = Rounds::find($id);
        if (!$round) {
            abort(404);
        }
        return $round;
    }

    /**
     * Deletes the data, if it exists
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $round = Rounds::find($id);
        if (!$round) {
            abort(404);
        }
        $round->delete();
        return response()->json([
            'success' => 'Sikeres törlés!'
        ], 201);
    }

    /**
     * Redirecting to the page where based on the competition rounds are shown
     * @param mixed $comp_name
     * @param mixed $comp_year
     * @return \Illuminate\Contracts\View\View
     */
    public function show($comp_name, $comp_year)
    {
        $round = Rounds::where('comp_name', '=', $comp_name)->where('comp_year', '=', $comp_year)->get();
        $scoreBoard = Competitors::orderByRaw('points DESC')->get();
        return view("rounds.show", ["rounds" => $round, "scoreBoard" => $scoreBoard]);
    }

    /**
     * Redirecting to the page where the users rounds are shown
     * @param mixed $user_email
     * @return \Illuminate\Contracts\View\View
     */
    public function showUser($user_email)
    {
        $userRounds = Rounds::select()
            ->leftJoin('competitors', 'competitors.round_id', '=', 'rounds.id')
            ->where('competitors.user_email', '=', $user_email)
            ->get();
        return view("rounds.user-show", ["userRounds" => $userRounds]);
    }
}
