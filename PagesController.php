<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Tournament;
use App\Post;
use App\TournamentSingle;
use App\Player;
use App\Rating;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Input;
use App\Flag;
use App\User;
use App\Tag;
use App\Role;
use App\ImageCollection;
use App\ImageAlbum;
use App\Video;
use App\Wtaranking;
use App\NoticeCategory;
use App\PrivateNotice;
use App\City;
use Carbon\Carbon;
use App\Court;
use App\Banner;

class PagesController extends Controller
{
    public function getIndex()
    {   
        $pst = Post::where('to_mainpage', '1')->orderBy('created_at', 'desc')->get();
        $post =  Post::where('to_mainpage', '1')->orderBy('created_at', 'desc')->first();
        $secondpost = Post::where('to_mainpage', '1')->orderBy('created_at', 'desc')->offset(1)->first();
        $anothermainposts = Post::where('to_mainpage', '1')->orderBy('created_at', 'desc')->skip(1)->take(3)->get();
        $uaposts_ = Post::where('location', 1)->get();
        $uaposts = $uaposts_->sortByDesc('created_at')->take(9)->all();
        $worldposts_ = Post::where('location', 2)->get();
        $worldposts = $worldposts_->sortByDesc('created_at')->take(9)->all();
        $unapprovedPrivateNotices = PrivateNotice::where('isApproved', 0)->count();
        $lastnews = Post::orderBy('created_at', 'DESC')->take(15)->get();
        $offcourt_news = Post::where('category_id', 7)->orderBy('created_at', 'DESC')->take(9)->get();
        $banners = Banner::all();

    return view('pages.index')
        ->with('post', $post)
        ->with('secondpost', $secondpost)
        ->with('anothermainposts', $anothermainposts)
        ->with('uaposts', $uaposts)
        ->with('worldposts', $worldposts)
        ->with('unapp', $unapprovedPrivateNotices)
        ->with('lastnews', $lastnews)
        ->with('offcourt_news', $offcourt_news)
        ->with('banners', $banners);
    }

    public function getCalendar() 
    {
        $tourns = Tournament::orderBy('tournament_start', 'ASC')->get();
        $mytime = Carbon::now()->timestamp;
        $banners = Banner::all();
        
    	return view('pages.calendar')
        ->with('tourns', $tourns)
        ->with('time_now', $mytime)
        ->with('banners', $banners);
    }

    public function getRollandGarros()
    {
        return view('pages.rg');
    }

    public function getATP()
    {
        $latest_date = Rating::max('created_at');
        $strdate = strtotime($latest_date);
        $approxDate = gmdate("Y-m-d", $strdate);
        $currentPage = Rating::where('category', 'singles')->where('created_at', 'like', '%' . $approxDate . '%')->take(100)->orderBy('order', 'ASC')->get();
         $banners = Banner::all();
    	return view('pages.atpranking')
            ->with('ranks', $currentPage)
            ->withAmount(100)
            ->with('banners', $banners);
    }

        public function getWTA()
    {

        $latest_date = Wtaranking::max('created_at');
        $strdate = strtotime($latest_date);
        $approxDate = gmdate("Y-m-d", $strdate);
         $banners = Banner::all();
        $rankings = Wtaranking::where('category', 'singles')->where('created_at', 'like', '%' . $approxDate . '%')->take(100)->orderBy('order', 'ASC')->get();
        return view('pages.wtaranking')->withRankings($rankings)->withAmount(100)->with('banners', $banners);
    }

    public function showATP(Request $request)
    {
        session()->has('atp_amount') ? '' : session()->put('atp_amount', 100);
        session()->has('atp_player_category') ? '' : session()->put('atp_player_category', 'singles');

        if(!empty($request->atp_amount)){
            session()->put('atp_amount', $request->atp_amount);    
        }
        if(!empty($request->atp_player_category)){
            session()->put('atp_player_category', $request->atp_player_category);
        }
        $latest_date = Rating::max('created_at');
        $strdate = strtotime($latest_date);
        $approxDate = gmdate("Y-m-d", $strdate);
        $player_category = session()->get('atp_player_category');
        $amount = session()->get('atp_amount');
        $amount = intval($amount);
        $ranks_single_ = Rating::where('category', $player_category)->get();
        $ranks_single = $ranks_single_->sortBy('order')->take($amount)->all();
        $someslice = Rating::where('category', $player_category)->where('created_at', 'like', '%' . $approxDate . '%')
        ->take($amount)->orderBy('order', 'ASC')->paginate(100);

        return view('pages.atpranking')->with('ranks', $someslice)->withAmount($amount);
    }

        public function showWTA(Request $request)
    {
        session()->has('amount') ? '' : session()->put('amount', 100);
        session()->has('player_category') ? '' : session()->put('player_category', 'singles');

        if(!empty($request->amount)){
            session()->put('amount', $request->amount);    
        }
        if(!empty($request->player_category)){
            session()->put('player_category', $request->player_category);
        }
        $latest_date = Wtaranking::max('created_at');
        $strdate = strtotime($latest_date);
        $approxDate = gmdate("Y-m-d", $strdate);
        $player_category = session()->get('player_category');
        $amount = session()->get('amount');
        $amount = intval($amount);
        $someslice = Wtaranking::where('category', $player_category)
        ->where('created_at', 'like', '%' . $approxDate . '%')
        ->take($amount)->orderBy('order', 'ASC')->paginate(100);

        return view('pages.wtaranking')->with('rankings', $someslice)
        ->withAmount($amount);
    }

    public function showSinglePlayer($id)
    {   
        $latest_date = Rating::max('created_at');
        $strdate = strtotime($latest_date);
        $approxDate = gmdate("Y-m-d", $strdate);
        $player = Player::find($id);
        $rating = Rating::where('player_id', $id)->where('created_at', 'like', '%' . $approxDate . '%')->first();
        $flag = $player->country_citizen;
        $short_flag_name_row = Flag::where('IOC', $flag)->first();
        $short_flag_name = strtolower($short_flag_name_row->alpha_2);
        $pName = mb_strtolower($player->name_ru);
        $playerIntags = Tag::where('name', $pName)->first();

        return view('pages.singlePlayer')
            ->with('player', $player)
            ->with('rating', $rating)
            ->with('short_flag_name', $short_flag_name)
            ->with('tag', $playerIntags);
    }

    public function showWTASinglePlayer($id)
    {   
        $latest_date = Wtaranking::max('created_at');
        $strdate = strtotime($latest_date);
        $approxDate = gmdate("Y-m-d", $strdate);
        $player = Player::find($id);
        $rating = Wtaranking::where('player_id', $id)->where('created_at', 'like', '%' . $approxDate . '%')->first();
        $flag = $player->country_citizen;
        $short_flag_name_row = Flag::where('IOC', $flag)->first();
        $short_flag_name = strtolower($short_flag_name_row->alpha_2);
        $pName = mb_strtolower($player->name_ru);
        $playerIntags = Tag::where('name', $pName)->first();

        return view('pages.WTAsinglePlayer')
            ->with('player', $player)
            ->with('rating', $rating)
            ->with('short_flag_name', $short_flag_name)
            ->with('tag', $playerIntags);
    }


    public function getScore()
    {
      $banners = Banner::all();
    	return view('pages.scores')
          ->with('banners', $banners);
    }

    public function getArticles()
    {
        $articles = Post::where('category_id', 9)->orderBy('created_at', 'DESC')->paginate(25);
        $banners = Banner::all();

    	return view('pages.articles')
            ->with('articles', $articles)
            ->with('banners', $banners);
    }

    public function getInterviews()
    {
      $banners = Banner::all();
      $interviews = Post::where('category_id', 3)->orderBy('created_at', 'DESC')->paginate(25);

      return view('pages.interviews')
          ->with('interviews', $interviews)
          ->with('banners', $banners);
    }

    public function getBlogs()
    {
      $banners = Banner::all();
      $blogs = Post::where('category_id', 1)->orderBy('created_at', 'DESC')->paginate(25);
      $bloggers = Role::find(2)->users()->get();

      return view('pages.blogs')
          ->with('blogs', $blogs)
          ->with('bloggers', $bloggers)
          ->with('banners', $banners);
    }

    public function getNews()
    {
        $banners = Banner::all();
        $today_news = Post::where('category_id', 5)->whereDate('created_at', DB::raw('CURDATE()'))->orderBy('created_at', 'desc')->get();
        $news = Post::where('category_id', 5)->orderBy('created_at', 'DESC')->paginate(25);

        return view('pages.news')
            ->with('news', $news)
            ->with('todaynews', $today_news)
            ->with('banners', $banners);
    }

        public function getVideocontent()
    {
        $topVideo = Video::orderBy('created_at', 'DESC')->where('topfixed', 1)->first();
        $twID = $topVideo->id;
        $videos = Video::whereNotIn('id', array($twID))->orderBy('created_at', 'DESC')->paginate(8);

    	return view('pages.videos')->withVideos($videos)->with('topVideo', $topVideo);
    }

        public function getImages()
        {
            $albums = ImageAlbum::orderBy('created_at', 'DESC')->paginate(5);

            return view('pages.images')->withAlbums($albums);
        }

        public function getSingle($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        $post->views += 1;
        $post->corrected_views += 1;
        $post->save();
        $comments = $post->comments()->where('approved', true)->get();
        $latest = Post::whereNotIn('id', [$post->id])->latest()->take(10)->get();

        return view('blogs.single')
        ->with('post', $post)
        ->with('comments', $comments)
        ->with('lastnews', $latest);
    }

    public function getBlogerpage($bloger_id)
    {
        $bloger = User::findOrFail($bloger_id);
        $posts = Post::where('user_id', $bloger_id)->orderBy('created_at', 'DESC')->paginate(25);

        return view('pages.bloger')->with('bloger', $bloger)->with('posts', $posts);
    }

    public function getSearch(Request $request)
    {
        $s = $request->input('s');
        $results = Post::latest()->search($s)->paginate(25);

        return view('pages.searchres', compact('results', 's'));
    }

    public function getRelated($id)
    {
        $tag = Tag::find($id);

        return view('pages.related')->with('tag', $tag);
    }

    public function getWorldNews()
    {
        $wnews = Post::where('location', 2)->orderBy('created_at', 'DESC')->paginate(25);
        $banners = Banner::all();

        return view('pages.worldnews')
            ->with('news', $wnews)
            ->with('banners', $banners);
    }

    public function getUaNews()
    {
        $uanews = Post::where('location', 1)->orderBy('created_at', 'DESC')->paginate(25);
        $banners = Banner::all();

        return view('pages.uanews')
            ->with('news', $uanews)
            ->with('banners', $banners);
    }

    public function getPics()
    {
        return view('pages.images');
    }

    public function getNotices()
    {
        $cats = NoticeCategory::all();
        $cities = City::all();
        $notices = PrivateNotice::where('isApproved', true)->orderBy('created_at', 'DESC')->take(10)->get();

        return view('pages.notices')
            ->withCats($cats)
            ->withNotices($notices)
            ->withCities($cities);
    }

    public function PostNotices(Request $request)
    {
        $cats = NoticeCategory::all();
        $cities = City::all();
        $notices = PrivateNotice::where('isApproved', true)
        ->where('category_id', $request->category_id)
        ->where('city_id', $request->city)
        ->orderBy('created_at', 'DESC')
        ->paginate();

        return view('pages.postnotices')
            ->withCats($cats)
            ->withNotices($notices)
            ->withCities($cities);
    }

    public function getOnline() {
      $banners = Banner::all();

        return view('pages.online')
          ->withBanners($banners);
    }

    public function getCourts(){
      $banners = Banner::all();
        return view('pages.courts')->withBanners($banners);
    }

    public function getCourt($id){
        $singleCourt = Court::find($id);
        $cName = $singleCourt->name;
        $banners = Banner::all();
        $courtIntags = Tag::where('name', $cName)->first();

        return view('pages.court')
            ->withCourt($singleCourt)
            ->withTag($courtIntags)
            ->withBanners($banners);
    }

    public function getOffcourt(){
        $offcourts = Post::where('category_id', 7)->orderBy('created_at', 'DESC')->paginate(25);
        $banners = Banner::all();
        
        return view('pages.offcourts')
            ->withOffcourts($offcourts)
            ->withBanners($banners);
    }
}
