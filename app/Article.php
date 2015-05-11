<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model {

	protected $fillable = ['title', 'body', 'published_at'];
	protected $dates = ['published_at'];							// 日付ミューテーターの指定

	public function scopePublished($query) {						//取得するデータを制限　->published()で利用
        $query->where('published_at', '<=', Carbon::now());
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps();	//中間テーブル名'article_tag'、中間テーブルの外部キー'article_id'と'tag_id'は省略可
    }

    public function getTagListAttribute() {							//$article->tag_list() で tagの id の配列が取得出来るように
        return $this->tags->lists('id');
    }
    
}