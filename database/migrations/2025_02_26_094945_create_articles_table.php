<?php

use App\Enum\ArticleStatus;
use App\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->string('title')->unique();
            $table->string('content');
            $table->string('img_url')->nullable();
            $table->date('published_date')->nullable();
            $table->string('status')->default(ArticleStatus::PUBLISHED->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
