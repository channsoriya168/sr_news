<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
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
}
