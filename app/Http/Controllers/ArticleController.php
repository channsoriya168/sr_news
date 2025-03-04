<?php

namespace App\Http\Controllers;

use App\Enum\ArticleStatus;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(){

        $perPage = request()->query('itemsPerPage', 5);
        $articles = Article::paginate($perPage)->appends(request()->query());
        return Inertia::render('Admin/Article/Index', [
            'articles' => $articles
        ]);
    }

    public function create(){

        $categories = Category::all();

        return Inertia::render('Author/CreateArticle', [
            'statuses' => ArticleStatus::all(),
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('img_url')) {
            $imagePath = $request->file('img_url')->store('articles', 'public');
        }

        DB::beginTransaction();

        try {
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id, // Ensure this is correctly sent from Vue
                'status' => $request->status,
                'img_url' => $imagePath,
                'published_date' => $request->published_date
            ]);

            DB::commit();
            return redirect()->route('author.home')->with('success', 'Article created.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('author.home')->with('error', 'Article not created.');
        }
    }

}
