<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index(){
        $posts = Post::simplePaginate(3);
        return view('welcome',compact('posts'));
    }

    function create(){
        return view('user.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|string|max:255',
            'content'=>'required',
            'img'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        if($request->hasFile('img')){
        $imagePath = $request->file('img')->store('uploads','public');
        $post->img = $imagePath;
        }
        $post->user_id = session('LoggedUser');
        $post->save();
        return redirect()->route('user.dashboard')->with('success','Post Created Successsfully');
    }

    public function destroy($id){
        $post = Post::find($id);
        if(!$post){
            return redirect()->route('user.dashboard')->with('error','Post Not Found');
        }
        if(session('LoggedUser') !== $post->user_id){
            return redirect()->route('user.dashboard')->with('error','Not Authorized');
        }
        $post->delete();
        return redirect()->route('user.dashboard')->with('success','Post Deleted Successsfully');
    }

    public function edit($id){
        $post = Post::find($id);
        if(!$post){
            return redirect()->route('user.dashboard')->with('error','Post Not Found');
        }
        if(!session('LoggedUser')){
            return redirect()->route('user.dashboard')->with('error','Mandatory to Login to edit');
        }
        if(session('LoggedUser') !== $post->user_id){
            return redirect()->route('user.dashboard')->with('error','Not Authorized');
        }
        return view('user.edit',['post'=>$post]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required',
            'img'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $post = Post::find($id);
        if(!$post){
            return redirect()->route('user.dashboard')->with('error','Post Not Found');
        }
        if(!session('LoggedUser')){
            return redirect()->route('user.dashboard')->with('error','Mandatory to Login to edit');
        }
        if(session('LoggedUser') !== $post->user_id){
            return redirect()->route('user.dashboard')->with('error','Not Authorized');
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        if($request->hasFile('img')){
            Storage::delete('public/'.$post->img);
            $imagePath = $request->file('img')->store('uploads','public');
            $post->img = $imagePath;
        }
        $post->save();
        return redirect()->route('user.dashboard')->with('success','Updated Successfully');
    }
}
