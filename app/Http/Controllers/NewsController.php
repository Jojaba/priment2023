<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show_all() {
        // Get the posts data and handle them before rendering
        // ***************************************************
        $user_id = auth()->user()->id; // string
        $user_role = auth()->user()->role; // Integer
        if($user_role < 15) {
            // For common case
            $all_granted_posts = Post::where('state', '=', 'published')
                ->where(function($query) {
                    $user_identity = auth()->user()->identity;
                    $query  ->where('target', '=', $user_identity)
                            ->orWhere('target', 'LIKE', $user_identity.',%')
                            ->orWhere('target', 'LIKE', '%,'.$user_identity)
                            ->orWhere('target', 'LIKE', '%,'.$user_identity.',%');
                        })
                ->orWhere('author_id', '=', $user_id)        
                ->orderBy('updated_at', 'desc') // Ordered by updated date
                ->get(); 
        } else {
            // For administrators
            $all_granted_posts = Post::where('id', '>', 0)->orderBy('updated_at', 'desc')->get();
        }
        if(count($all_granted_posts) > 0) {
            foreach($all_granted_posts as $post) {
                // get some datas from DB and format some others...
                //$target = explode(',', $post->target);
                $target = $post->target;
                $post_liked_users = explode(',', $post->post_liked_users);
                $post_liked_users_count = count($post_liked_users);
                $updated_at = date ("d/m/Y", strtotime($post->updated_at));
                // data about author
                $author_id = $post->author_id;
                $author_data = USER::where('id', '=', $author_id);
                $author_forename = $author_data->value('forename');
                $author_name = $author_data->value('name');
                $author_display_name = $author_forename.' '.$author_name;
                $posts[] = [
                    'id'                        => $post->id, // integer
                    'title'                     => $post->title, // string
                    'target'                    => $target, // array of identity
                    'author_id'                 => $post->author_id, //integer
                    'author_display_name'       => $author_display_name, // Forename and name of author
                    'content'                   => $post->content, // text
                    'associated_res'            => $post->associated_res, // integer
                    'post_liked_users_count'    => $post_liked_users_count, // integer (like count)
                    'post_liked_users'          => $post_liked_users, // array of user id
                    'state'                     => $post->state, // Published, unpublished, awaiting, or draft
                    'updated_at'                => $updated_at // Date format :  dd/mm/yyyy
                ];
            }
        } else {
            $posts = false;
        }
        // Rendering the data
        // ******************
        return Inertia::render('News', [
            'posts' => $posts
        ]);
    }

    public function show_single($post_id) {
        $single_post_data = Post::where('id', '=', $post_id)->get();
        if(count($single_post_data) > 0) {
            // get some datas from DB and format some others...
            //$target = explode(',', $single_post_data[0]['target']);
            $target = $single_post_data[0]['target'];
            $post_liked_users = explode(',', $single_post_data[0]['post_liked_users']);
            $post_liked_users_count = count($post_liked_users);
            $updated_at = date ("d/m/Y", strtotime($single_post_data[0]['updated_at']));
            $content = $single_post_data[0]['content'];
            // data about author
            $author_id = $single_post_data[0]['author_id'];
            $author_data = USER::where('id', '=', $author_id);
            $author_forename = $author_data->value('forename');
            $author_name = $author_data->value('name');
            $author_display_name = $author_forename.' '.$author_name;
            $post = [
                'id'                        => $single_post_data[0]['id'], // integer
                'title'                     => $single_post_data[0]['title'], // string
                'target'                    => $target, // array of identity
                'author_id'                 => $single_post_data[0]['author_id'], //integer
                'author_display_name'       => $author_display_name, // Forename and name of author
                'content'                   => $content, // text
                'associated_res'            => $single_post_data[0]['associated_res'], // integer
                'post_liked_users_count'    => $post_liked_users_count, // integer (like count)
                'post_liked_users'          => $post_liked_users, // array of user id
                'state'                     => $single_post_data[0]['state'], // Published, unpublished, awaiting, or draft
                'updated_at'                => $updated_at // Date format :  dd/mm/yyyy
            ];
        } else {
            $post = false;
        }
        // Rendering the data
        // ******************
        return Inertia::render('Singlenews', [
            'post' => $post
        ]);   
    }

    public function edit_single($post_id) {
        $single_post_data = Post::where('id', '=', $post_id)->get();
        // get some datas from DB and format some others...
        //$target = explode(',', $single_post_data[0]['target']);
        $target = $single_post_data[0]['target'];
        $post = [
            'id'                        => $single_post_data[0]['id'], // integer
            'title'                     => $single_post_data[0]['title'], // string
            'target'                    => $target, // array of identity
            'content'                   => $single_post_data[0]['content'], // text
            'associated_res'            => $single_post_data[0]['associated_res'], // integer
            'state'                     => $single_post_data[0]['state'] // Published, unpublished, awaiting, or draft
        ];
        
        // Rendering the data
        // ******************
        return Inertia::render('Singlenewsedit', [
            'post' => $post
        ]);   
    }

    public function update_single(Request $request, string $id) {
        $news = Post::find($id);
        $news->title = $request->title;
        $news->target = $request->target;
        $news->content = $request->content;
        $news->associated_res = $request->associated_res;
        $news->state = $request->state;
        $news->update();
        return to_route('news');
    }

    public function create_single() {
        return Inertia::render('Singlenewscreate');   
    }

    public function store_new_single(Request $request) {
        $user_id = auth()->user()->id;
        $news = new Post;
        $news->title = $request->title;
        $news->author_id = $user_id;
        $news->target = $request->target;
        $news->content = $request->content;
        $news->associated_res = $request->associated_res;
        $news->state = $request->state;
        $news->save();
        return to_route('news');
    }
}
