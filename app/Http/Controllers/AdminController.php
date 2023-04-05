<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\TokenMismatchException; 


class AdminController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function HomeAdmin()
    {
        $article =  article::all()->take(10);
        $CountArticle = article::all()->count();
        $CountCategory = category::all()->count();
        return view('Admin.Home',compact('CountArticle','CountCategory','article'));
    }
    public function EditArticle($id)
    {
        $category = DB::table('category')
                ->join('article', 'category.id', '=', 'article.id_cat')
                ->where('article.id', $id)
                ->get();
        $article= article::all()->where('id', $id);
        return view('Admin.EditArticle',compact('article','category'));
    }
    public function ViewArticleByCat($id)
    {
        $category= category::findOrFail($id);
        $article= article::all()->where('id_cat', $id);
        return view('User.ViewArticleByCat',compact('category','article'));
    }
    public function ViewDetailArticle($id)
    {
        $article= article::all()->where('id', $id);
        return view('User.ViewDetailArticle',compact('article'));
    }
    public function ViewHomeUser(Request $request)
    {
        $article = article::all();
        $category = category::all();
        return view('User.home',compact('article','category'));
    }
    public function SearchUser(Request $request)
    {
        $search = $request->input('SearchParam');
        $article = article::where('title_article',"Like","%"."$search"."%")->get();
        return view('User.Search',compact('article'));
    }
    public function ViewCategory(Request $request)
    {
        $category = category::all();
        return view('Admin.AddCategory',compact('category'));
    }
    public function AddCategory(Request $request)
    {
        $category = new category;
        $category->Category_Name = $request->input('Category_Name');
        if ($request->hasFile('imagess')) {
            $image = $request->file('imagess');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('/public/media');
            $image->move($destinationPath, $image_name);
        }
        $category->image =  $image_name;
        $category->save();
        return redirect()->back()->with('status','Category Added Successfully');
    }
    public function ViewEditCategory($id)
    {
        $category = category::find($id);
        return response()->json($category);
    }
    public function PostEditCategory(Request $request)
    {
        $id = $request->input('id');
        $category = category::find($id);
        $category->id = $id;
        $category->Category_Name = $request->input('Category_Modal_Name');
        $category->update();
        return redirect('/AddCategory');
    }
    public function DeleteCategory($id)
    {
        $category = category::find($id)->delete();
        return redirect()->back();
    }
    public function ViewArticle(Request $request)
    {
        $category = category::all();
        $article = article::all();
        return view('Admin.AddArticle',compact('category','article'));
    }
    public function ViewAllArticle(Request $request)
    {
        $category = category::all();
        $article = article::all();
        return view('Admin.ViewAllArticle',compact('category','article'));
    }
    public function uploadImage(Request $request) {		
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
         }
    }	
    public function AddArticle(Request $request)
    {
        $article = new article;
        $article->id_cat = $request->get('id_cat');
        $article->title_article = $request->input('title_article');
        $article->content_article = $request->input('content_article');
        $article->created_at = $request->input('created_at');
        $article->updated_at = $request->input('updated_at');
        $article->save();
        return redirect()->back()->with('status','Article Added Successfully');
    }
    public function ViewEditArticle($id)
    {
        $article = article::find($id);
        return response()->json($article);
    }
    public function PostEditArticle(Request $request)
    {
        $date = Carbon::now();
        $id=$request->input('edit_id');
        $article = article::find($id);
        $article->id = $id;
        $article->title_article = $request->input('edit_title_article');
        $article->content_article = $request->input('edit_content_article');
        $article->updated_at = $date->format("Y-m-d H:m:s");
        $article->id_cat =  $request->input('edit_id_cat');
        $article->update();
        return redirect('/ViewAllArticle');
    }
    public function DeleteArticle($id)
    {
        $article = article::find($id)->delete();
        return redirect()->back();
    }
}