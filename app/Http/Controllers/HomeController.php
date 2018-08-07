<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepositoryEloquent;
use App\Models\Visitor;

class HomeController extends Controller
{
    protected $article;


    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article = $article;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $server = $_SERVER;
        $vistors = new Visitor;

        $articles = $this->article
            ->with([
                'category'
            ])
            ->orderBy('sort','desc')
            ->orderBy('id', 'desc')
            ->paginate();

        if(!array_key_exists('HTTP_REFERER',$server)){

            $date = date('Y-m-d',time());

            $address = $request->getClientIp(); //获取客户端地址

            $vistor = $vistors->query()->where('created_at','like',$date.'%')->where('address',$address)->first();

            if ($vistor) {

                /*dd($vistor->getAttribute('count'));*/
                $vistor->count = $vistor->count + 1;

                $vistor->save();
                return view('default.home', compact('articles'));
            }


            $vistors->address = $address;
            $vistors->save();
        }

        return view('default.home', compact('articles'));

    }
}
