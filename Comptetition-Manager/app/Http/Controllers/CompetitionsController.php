<?php

namespace App\Http\Controllers;

use App\Models\Competitions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompetitionsController extends Controller
{
    /**
     * Returns the data from the Competitions table
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $competitions = Competitions::select('comp_name', 'comp_year', 'prize', 'description', 'address', 'comp_start', 'comp_end', 'languages', 'comp_limit', 'entry_fee');
        if ($request->ajax()) {
            return DataTables::of($competitions)->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="btn-sm btn btn-secondary editButton d-grid gap-2" data-comp_name="' . $row->comp_name . '" data-comp_year="' . $row->comp_year . '">Szerkeszt</a>
                <a href="javascript:void(0)" class="btn-sm btn btn-danger deleteButton d-grid gap-2" data-comp_name="' . $row->comp_name . '" data-comp_year="' . $row->comp_year . '">Töröl</a>';
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
        return view("competitions.create");
    }

    /**
     * Creates/Updates a Round
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'comp_name' => 'required|string|max:255',
            'prize' => 'required|numeric',
            'description' => 'string',
            'address' => 'required|string',
            'comp_start' => 'required|date',
            'comp_end' => 'required|date',
            'languages' => 'required',
            'comp_limit' => 'required|numeric',
            'entry_fee' => 'required|numeric',

        ]);

        $data['comp_year'] = date('Y', strtotime($data["comp_start"]));
        $data['languages'] = implode(', ', $data['languages']);

        if ($request->comp_edit != null) {
            $competition = Competitions::where('comp_name', $data['comp_name'])->where('comp_year', $data['comp_year'])->first();
            if (!$competition) {
                abort(404);
            }
            $competition->update([
                'prize' => $data['prize'],
                'description' => $data['description'],
                'address' => $data['address'],
                'comp_start' => $data['comp_start'],
                'comp_end' => $data['comp_end'],
                'languages' => $data['languages'],
                'comp_limit' => $data['comp_limit'],
                'entry_fee' => $data['entry_fee']
            ]);
            return response()->json([
                'success' => 'Sikeres módosítás!'
            ], 201);

        } else {
            if (Competitions::create($data)) {
                return response()->json([
                    'success' => 'Sikeres verseny felvétel'
                ], 201);
            }
        }
    }

    /**
     * Returns the editable data, if it exists
     * @param mixed $comp_name
     * @param mixed $comp_year
     * @return TModel
     */
    public function edit($comp_name, $comp_year)
    {
        $competition = Competitions::where('comp_name', $comp_name)->where('comp_year', $comp_year)->first();
        if (!$competition) {
            abort(404);
        }
        return $competition;
    }

    /**
     *  Deletes the data, if it exists
     * @param \Illuminate\Http\Request $request
     * @param mixed $comp_name
     * @param mixed $comp_year
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $comp_name, $comp_year)
    {
        $competition = Competitions::where('comp_name', $comp_name)->where('comp_year', $comp_year)->first();
        if (!$competition) {
            abort(404);
        }
        $competition->delete();
        return response()->json([
            'success' => 'Sikeres törlés!'
        ], 201);
    }

    /**
     * Redirect to the Competitions page 
     * @return \Illuminate\Contracts\View\View
     */
    public function show(){
        $competition = Competitions::all();
        return view("competitions.show",["competitions"=> $competition]);
    }
}
