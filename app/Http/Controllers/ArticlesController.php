<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Article;                        //Articleモデルを利用
use App\Tag;                            //Tagモデルを利用
use App\Http\Requests\ArticleRequest;	//ArticleRequest(FormRequest機能)を利用
use Carbon\Carbon;                      //Carbon機能を利用

class ArticlesController extends Controller {

    function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index() {
        //$articles = Article::all();                                               //全て取得
        //$articles = Article::orderBy('published_at', 'desc')->get();              //ソート
        //$articles = Article::latest('published_at')->get();                       //昇順にソート
        //$articles = Article::where('published_at', '<=', Carbon::now())->get();	//条件を指定
        $articles = Article::latest('published_at')->published()->get();            //scopeに公開日のvaridationをまかせる　Articleコントローラーに記述
        return view('articles.index', compact('articles'));
    }

    public function create() {
        $tags = Tag::lists('name', 'id');                   //Tagモデルから配列で取得
        return view('articles.create', compact('tags'));    //
    }

    public function store(ArticleRequest $request) {        //ArticleRequestのインスタンスを作成し入力値のチェック
        //Article::create($request->all());
        $articles = \Auth::user()->articles()->create($request->all());
        $articles->tags()->attach($request->input('tag_list'));
        \Session::flash('flash_message', '記事を作成しました。');
        return redirect()->route('articles.index');
    }
 
    public function show($id) {
    	$article = Article::findOrFail($id);
        $tags = Tag::lists('name', 'id');
		return view('articles.show', compact('article'));
	}

    public function edit($id) {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));

    }
 
    public function update($id, ArticleRequest $request) {	//ArticleRequestで入力値のチェック
        $article = Article::findOrFail($id);
        $article->update($request->all());
        $article->tags()->sync($request->input('tag_list'));
        \Session::flash('flash_message', '記事を更新しました');
        //return redirect(url('articles', [$article->id]));
        return redirect()->route('articles.index', [$article->id]);

    }

    public function destroy($id) {
        $article = Article::findOrFail($id);
        $article->delete();
        \Session::flash('flash_message', '記事を削除しました。');
        //return redirect('articles');
        return redirect()->route('articles.index');
    }
}
