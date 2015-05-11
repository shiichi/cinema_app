<?php
 
use App\User;
use App\Article;
use App\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
 
class DatabaseSeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        $this->call('UsersTableSeeder');
	$this->call('ArticlesTableSeeder');
	$this->call('PositionsTableSeeder');
    }
}

class UsersTableSeeder extends Seeder {
 
    public function run() {
        DB::table('users')->delete();
 
        User::create([
            'name' => 'shiichi',
            'email' => 's.shiichi311041@gmail.com',
            'password' => bcrypt('111111')
        ]);
    }
}
class ArticlesTableSeeder extends Seeder {
 
    public function run() {
	DB::table('articles')->delete();
	$user = User::all()->first()->id;
	
	Article::create([
	    'user_id' => $user,
            'title' => 'first article',
            'body' => 'This is the first article. Thank you!!',
            'published_at' => Carbon::now(),
        ]);
    }
}

class PositionsTableSeeder extends Seeder {

    public function run() {
        DB::table('positions')->delete();

        Position::create([
            'position' => '監督',
            'details' => '映画監督（ディレクター）とは、映画の映像作成を統括する責任者である。一般に、製作者（プロデューサー）に次いで、その映画のトップ2となる。
基本的な責任範囲は「映画作品としての品質管理」である。「企画（どういう映画を作るかという案を策定する）」、「製作（製作費の調達や管理、作品の売り出しなどを決定する）」は基本的にプロデューサーの職分であり、監督という職種の本来の責任範囲ではない（ただし、監督がプロデューサーを兼ねる場合もある）。
監督の仕事は、完成した脚本を受け取ってから始まる（それ以前にも脚本を完成させるための議論に参加するなどの仕事が発生するが、脚本が完成するまでは、基本的に脚本家の仕事である）。ただし、監督自らが脚本を書く場合も少なくない。また、完成脚本に手を入れることで、結果的に脚本家との共同脚本としてクレジットされる場合もあれば、監督が手を入れていても特にクレジットはされない場合もある。'
        ]);
        Position::create([
            'position' => '脚本',
            'details' => '脚本家（シナリオライター）とは、脚本（シナリオ）を作る仕事を担当する。
脚本は俳優がしゃべる「台詞」と、場面や状況の説明、俳優の動きなどの指定をする「ト書き」によって構成され、関係者は脚本に基づいてそれぞれの担当分野でのプランを作成する。役者は脚本に基づいて役の肉付けを考え、照明スタッフは照明プランを、美術スタッフはセットや衣装のプランを、音響スタッフは音響プランを、特撮スタッフはまた特撮カットのプランを練り上げていく。
つまり脚本とは映像作品の設計図であり、脚本家は映像作品の設計者といえる。原作がある場合は、すでに読者の作品に対するイメージが固まっていることが多く、その期待に応える洞察力と、逆に観客の予想を良い意味で裏切って驚嘆・感動させる構想力が重要になる。'
        ]);
        Position::create([
            'position' => '原作',
            'details' => 'その映画の原作となった小説、漫画などの作者である。映画の作成には関わらないことが多いが、原作者が脚本を作成するなど映画作成に深く関わるケースも見られる'
        ]);
        Position::create([
            'position' => '製作総指揮',
            'details' => '製作者（プロデューサー）とは、映画を企画、立案し、作品にする総合責任者である。一般に、その映画における最高責任者である。
製作総指揮（エグゼクティブプロデューサー）は、ここで定義する映画プロデューサーとは、必ずしも一致しない。映画製作において具体的な実務内容が定められておらず、一般には、プロデューサーに対して社会的経済的信用を付与する存在と理解されている。
近年のハリウッドでは「リメイク作」や「アメコミの映画化」などで「映画の元となる作品の権利を持つ人物」は、その作品にまったくタッチしていなくても「エグゼクティブプロデューサー」にクレジットされる慣習となっている。これに対し、邦画におけるエグゼクティブ・プロデューサーは、洋画と同じ意味合いで使われる場合もあるが、「複数のプロデューサーの中の筆頭者」を意味する場合もあるし、「映画出資者（もしくは出資会社の代表者等）」に対して、この肩書きを与えることもある。'
        ]);
        Position::create([
            'position' => '製作',
            'details' => '製作者（プロデューサー）とは、映画を企画、立案し、作品にする総合責任者である。一般に、その映画における最高責任者である。
仕事は、映画の企画の考案から始まる。制作費を集め、映画監督や脚本家、スタッフを決め、制作スケジュールを立てる。撮影が始まれば、制作現場の指揮をとり、編集にも参加する。映画が完成したら、興行する映画館を決め、宣伝プランを考る。
このように、映画プロデューサーの仕事は、作品制作、そして資金確保から売上げの回収、その後の著作権管理まで、すべての仕事に責任者として関わることとなる。'
        ]);
        Position::create([
            'position' => '撮影',
            'details' => '撮影監督（カメラマン）は脚本のイメージを具体的にフィルムに映像化する仕事を担当する。
仕事はカメラ・レンズ・フィルムの選択に始まり、ポジションやアングル、構図、カット割、カメラワーク、光の強弱や色彩調整、美術・照明など他スタッフとの打ち合わせなど映像撮影に関わる業務全般である。
撮影監督はそういった選択を監督と話し合って決定する。監督が脚本にどのようなイメージを持っていて、どのような映像を求めているのか。そしてそれを映像化するにはどうすればいいのか、それを理解し支えるのが撮影監督の仕事である。'
        ]);
        Position::create([
            'position' => '美術',
            'details' => '美術監督（プロダクションデザイナー）とは、撮影の被写体となる空間を作る作業を取り仕切る人である。
監督やプロデューサーと打ち合わせを行い、予算内でその映画の世界観（背景）を作り上げる。俳優以外の映像部分はこの美術監督によって作り上げられている。'
        ]);
        Position::create([
            'position' => '音楽',
            'details' => '音楽監督（ミュージックディレクター）とは、音楽部門を取り仕切る人である。
映画作品を通して貫かれている主題、登場人物の感情や性格、場面の状況などを、音楽という抽象的な表現形式によって視聴者に伝達する、重要な役割をもつ。'
        ]);
        Position::create([
            'position' => '映像編集',
            'details' => '映像編集者（フィルムエディター）とは、撮影された映像のアングル、カットなどを吟味し編集する仕事である。
撮られた映像を「どう見せるか」を担当している。監督はエディターが一番いい映像を選択できるよう、様々なアングルの素材を撮影（完成作品の約10～100倍の量）し、エディターは、そのなかから1番良い素材を選び、つなぎ合わせていく。'
        ]);
        Position::create([
            'position' => '作画',
            'details' => '作画を担当した人物'
        ]);
        Position::create([
            'position' => '字幕・吹替',
            'details' => '日本語版の字幕翻訳、吹替翻訳や演出に携わった人物'
        ]);
        Position::create([
            'position' => 'その他',
            'details' => 'その他映画製作に携わった人物'
        ]);
        Position::create([
            'position' => 'キャスト',
            'details' => 'その映画に出演した人物'
        ]);
    }
}
