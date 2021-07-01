<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Management Category',
            'categories' => Category::orderBy('id', 'desc')->get()
        ];

        return view('dashboard.category.index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Category #' . $id,
            'item' => Category::findOrFail($id)
        ];

        return view('dashboard.category.detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Category'
        ];

        return view('dashboard.category.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:190'
        ]);

        DB::beginTransaction();
        try {
            $category = new Category;
            $category->name = $request->name;

            $category->save();

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->with('dangerMessage', 'Error when insert data');
        }

        return redirect()->route('dashboard.category.index')
            ->with('successMessage', 'Success insert data');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);

        DB::beginTransaction();
        try {
            $category->name = $request->name;
            $category->save();

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
        $category = Category::findOrFail($id);

        DB::beginTransaction();
        try {
            $category->delete();

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->with('dangerMessage', 'Error deleted category ' . $category->name);
        }

        return redirect()->route('dashboard.category.index')
            ->with('successMessage', 'Success deleted category ' .$category->name);
    }
}
