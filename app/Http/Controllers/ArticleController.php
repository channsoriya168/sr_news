<?php

namespace App\Http\Controllers;

use App\Enum\ArticleStatus;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request){

        $perPage = request()->query('itemsPerPage', 5);
        $articles = Article::paginate($perPage)->appends(request()->query());
        // dd(Storage::temporaryUrl('articles/' . 'h4ixPwjUYWp6ZEn8WDAry8QMTec840vHnznxys17.jpg', now()->addMinutes(5)));
        return Inertia::render('Admin/Article/Index', [
            'articles' => $articles,
        ]);
    }

    public function create(Request $request){

        $authors = User::where('role', 'author')->get();
        $statuses = ArticleStatus::all();
        $categories = Category::all();
        return Inertia::render('Author/CreateArticle', [
            'statuses' => $statuses,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     // 'title' => 'required|string',
        //     // // 'content' => 'required|string',
        //     // 'category_id' => 'required|exists:categories,id',
        //     // 'status' => 'required|string',
        //     // 'img_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     // 'published_date' => 'nullable|date',
        // ]);
        $imagePath = null;

        if ($request->hasFile('img_upload')) {
            $imagePath = Storage::disk('wasabi')->put('articles', $request->file('img_upload'));
        }

        DB::beginTransaction();

        try {
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'author_id' => $request->author_id,
                'status' => $request->status,
                'img_upload' => $imagePath,
                'published_date' => $request->published_date
            ]);

            DB::commit();

            return redirect()->route('author.home')->with('success', 'Article created.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('author.home')->with('error', 'Article not created. Error: ' . $e->getMessage());
        }
    }

    public function delete(Article $article){
        return Inertia::render('Admin/Article/Delete', [
            'article' => $article,
        ]);
    }

    public function destroy(Article $article)
    {
        DB::beginTransaction();

        try {

            $article->delete();

            DB::commit();

            return redirect()->route('admin.article.index')->with('success', 'article deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.category.index')->with('error', 'article not deleted.');
        }
    }

}
