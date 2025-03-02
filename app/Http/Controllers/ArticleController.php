<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(){

        $perPage = request()->query('itemsPerPage', 5);
        $articles = Article::paginate($perPage)->appends(request()->query());
        return Inertia::render('Admin/Article/Index');
    }
}
