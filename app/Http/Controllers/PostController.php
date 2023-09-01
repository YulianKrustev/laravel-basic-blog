<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\Models\Post; 
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->limit(12)->get();

        return view('home.index', compact('posts'));

    } //End Function
    
    public function all()
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(9);

        return view('posts.all', compact('posts'));

    } //End Function

    public function add()
    {
        $categories = Category::orderBy('name','asc')->get();

        return view("posts.add", compact('categories'));

    } //End Function

    public function store(Request $request)
    {      
        $request->validate([
            'title' => 'required|string|min:2|max:40',
            'category' => 'integer', 
            'image' => 'required',
            'review' => 'required|string|min:2|max:5000'
        ],[
            'category.integer' => 'Please select category.',
        ]);

        $image = $request->image;
        
        $user_id = Auth::user()->id;
            
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(450 ,253)->save('posts_images/' . $name_gen);

        $save_url = 'posts_images/'. $name_gen;


        Post::insert([
            'title' => $request->title,
            'user_id' => $user_id,
            'category_id' => $request->category,
            'content' => $request->review,
            'image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Post Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('home')->with($notification);

    } //End Function

    public function details($id)
    {
        $post = Post::findOrFail($id);

        return view("posts.details", compact('post'));

    } //End Function

    public function search(Request $request) 
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'like', "%$query%")->get();

        return view('home.index', compact('posts'));

    } //End Function

    public function myPosts() 
    {
        $user_id = Auth::user()->id;
        $posts = Post::where('user_id', $user_id)->get();

        return view('posts.my-posts', compact('posts'));

    } //End Function

    public function searchByCategory($category_id) 
    {   
        $posts = Post::where('category_id', $category_id)->get();

        return view('home.index', compact('posts'));

    } //End Function

    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::orderBy('name','asc')->get();

        return view('posts.edit', compact('post', 'categories'));
    } //End Function

    public function update(Request $request, $id)
    {
        $post_id = $id;
        
        if ($request->file('image')) {
        
            $post = Post::findOrFail($id);
            $old_image = $post->image;
            unlink($old_image);

            $image = $request->file('image');            
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();           
            Image::make($image)->resize(430 ,327)->save('posts_images/' . $name_gen);
            $save_url = 'posts_images/'. $name_gen;

            $post->update([
                'title' => $request->title,
                'category_id' => $request->category,
                'content' => $request->review,
                'image' => $save_url,
                'updated_at' => Carbon::now()
            ]);           
        } else{
             Post::findOrFail($post_id)->update([
                'title' => $request->title,
                'category_id' => $request->category,
                'content' => $request->review,
                'updated_at' => Carbon::now()
            ]);
        } 

         $notification = [
                'message' => 'Post Updated Successfully',
                'alert-type' => 'success'
            ];

        return redirect()->route('home')->with($notification);

    } //End Function

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $image = $post->image;
        unlink($image);
        
        Post::findOrFail($id)->delete();

        $notification = [
                'message' => 'Post Deleted Successfully',
                'alert-type' => 'success'
            ];

        return redirect()->route('home')->with($notification);
    } // End Function

    public function addComment(Request $request, Post $post)
    {
        $request->validate(['content' => 'required']);
        $post->comments()->create([
        'content' => $request->content,
        'user_id' => auth()->id(),
        ]);

    return redirect()->back();
    } // End Function

    public function likePost(Post $post)
    {
        $post->likes()->attach(auth()->user());

        return redirect()->back();
    } // End Function

    public function unlikePost(Post $post)
    {
        $post->likes()->detach(auth()->user());

        return redirect()->back();
    } // End Function
}