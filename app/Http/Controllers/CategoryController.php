<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $perPage = request()->query('itemsPerPage', 5);
        $categories = Category::paginate($perPage)->appends(request()->query());

        return Inertia::render('Admin/Category/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('admin.category.index')->with('success', 'Category created.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.category.index')->with('error', 'Category not created.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return Inertia::modal('Admin/Category/Show', [
            'category' => $category,
        ])->baseRoute('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::modal('Admin/Category/Edit', [
            'category' => $category,
        ])->baseRoute('admin.category.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        DB::beginTransaction();

        try {

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('admin.category.index')->with('success', 'category updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.category_types.index')->with('error', 'category not updated.');
        }
    }

    public function delete(Category $category)
    {
        return Inertia::modal('Admin/Category/Delete', [
            'category' => $category,
        ])->baseRoute('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();

        try {

            $category->delete();

            DB::commit();

            return redirect()->route('admin.category.index')->with('success', 'category deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.category.index')->with('error', 'category not deleted.');
        }
    }
}
