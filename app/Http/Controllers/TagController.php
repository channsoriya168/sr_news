<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index(){
        $perPage = request()->query('itemsPerPage', 5);
        $tags = Tag::paginate($perPage)->appends(request()->query());

        return Inertia::render('Admin/Tag/Index', [
            'tags' => $tags,
        ]);
    }

    public function show(Tag $tag){
        return Inertia::render('Admin/Tag/Show', [
            'tag' => $tag
        ]);
    }

    public function create(){
        return Inertia::render('Admin/Tag/Create');
    }

    public function store(Request $request){
        DB::beginTransaction();

        try {
            Tag::create([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('admin.tag.index')->with('success', 'Tag created.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.tag.index')->with('error', 'tag not created.');
        }
    }

    public function edit(Tag $tag){
        return Inertia::render('Admin/Tag/Edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag){
        DB::beginTransaction();

        try {

            $tag->update([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('admin.tag.index')->with('success', 'Tag updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.tag.index')->with('error', 'Tag not updated.');
        }
    }

    public function delete(Tag $tag){
        return Inertia::render('Admin/Tag/Delete', [
            'tag' => $tag
        ]);
    }

    public function destroy(Tag $tag){
        DB::beginTransaction();

        try {

            $tag->delete();

            DB::commit();

            return redirect()->route('admin.tag.index')->with('success', 'tag deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.tag.index')->with('error', 'tag not deleted.');
        }
    }
}
