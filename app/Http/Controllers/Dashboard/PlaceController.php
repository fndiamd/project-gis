<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Place;
use App\Models\Category;

class PlaceController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Management Place',
            'places' => Place::orderBy('updated_at', 'desc')->get()
        ];

        return view('dashboard.place.index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Place #' . $id,
            'item' => Place::findOrFail($id),
            'categories' => Category::orderBy('id', 'desc')->get()
        ];

        return view('dashboard.place.detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Place',
            'categories' => Category::orderBy('id', 'desc')->get()
        ];

        return view('dashboard.place.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:190',
            'category' => 'required',
            'price' => 'required|integer',
            'address' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $place = new Place;
            $place->category_id = $request->category;
            $place->name = $request->name;
            $place->price = $request->price;
            $place->address = $request->address;
            $place->latitude = $request->latitude;
            $place->longitude = $request->longitude;
            $place->operational_start = $request->operational_start;
            $place->operational_end = $request->operational_end;
            $place->save();

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->with('dangerMessage', 'Error when insert data');
        }

        return redirect()->route('dashboard.place.index')
            ->with('successMessage', 'Success insert data');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $place = Place::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:190',
            'category' => 'required',
            'price' => 'required|integer',
            'address' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $place->category_id = $request->category;
            $place->name = $request->name;
            $place->price = $request->price;
            $place->address = $request->address;
            $place->latitude = $request->latitude;
            $place->longitude = $request->longitude;
            $place->operational_start = $request->operational_start;
            $place->operational_end = $request->operational_end;
            $place->save();

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()
                ->withInput()
                ->with('dangerMessage', 'Error update data');
        }

        return redirect()->back()
            ->with('successMessage', 'Success update data');
    }

    public function delete($id)
    {
        $place = Place::findOrFail($id);

        DB::beginTransaction();
        try {
            $place->delete();

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->with('dangerMessage', 'Error deleted place ' . $place->name);
        }

        return redirect()->route('dashboard.place.index')
            ->with('successMessage', 'Success deleted place ' .$place->name);
    }

    public function mapData(Request $request)
    {
        if (isset($request->category_id)) {
            $places = Place::whereIn('category_id', $request->category_id)->get();
        }else{
            $places = Place::get();
        }
        return json_encode($places);
    }
}
