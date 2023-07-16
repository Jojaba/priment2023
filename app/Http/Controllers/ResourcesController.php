<?php

namespace App\Http\Controllers;
use App\Models\Resource;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function show_all() {
        // Get the posts data and handle them before rendering
        // ***************************************************
        $user_identity = auth()->user()->identity; // student, teacher, ...
        if($user_identity == 'teacher' || $user_identity == 'admin') {
            // Get all resources
            $all_resources = Resource::where('id', '>', 0)->orderBy('updated_at', 'desc')->get(); // Ordered by updated date
        } else {
            // Get only published resources
            $all_resources = Resource::where('state', '=', 'published')->orderBy('updated_at', 'desc')->get(); // Ordered by updated date, only published
        }
        if(count($all_resources) > 0) {
            foreach($all_resources as $resource) {
                // The resources are visible for all connected users
                // Converting date and time before generating the resource datas                
                $res_liked_users = explode(',', $resource->hw_liked_users); // integer array (users id that liked)
                $res_liked_users_count = count($res_liked_users); // integer (like count)
                $updated_at = date ("d/m/Y", strtotime($resource->updated_at));
                // data about author
                $author_id = $resource->author_id;
                $author_data = USER::where('id', '=', $author_id);
                $author_forename = $author_data->value('forename');
                $author_name = $author_data->value('name');
                $author_display_name = $author_forename.' '.$author_name;
                $resources[] = [
                    'id'                        => $resource->id, // integer
                    'title'                     => $resource->title, // string
                    'url'                       => $resource->url, // string
                    'location'                  => $resource->location, // web or local
                    'type'                      => $resource->type, // doc, pdf, svg, mp4,...
                    'author_id'                 => $resource->author_id, //integer
                    'author_display_name'       => $author_display_name, // Forename and name of author
                    'post_liked_users_count'    => $res_liked_users_count,
                    'post_liked_users'          => $res_liked_users, // array of user id
                    'state'                     => $resource->state, // Published, unpublished, awaiting, or draft
                    'updated_at'                => $updated_at // Date format :  dd/mm/yyyy
                ];
            }
        } else {
            $all_resources = false;
        }
        // Rendering the data
        // ******************
        return Inertia::render('Resources', [
            'resources' => $resources
        ]);
    }

    public function show_single($res_id) {
        $single_res_data = Resource::where('id', '=', $res_id)->get();
        if(count($single_res_data) > 0) {
            // The resources are visible for all connected users
                // Converting date and time before generating the resource datas
                $res_liked_users = explode(',', $single_res_data[0]['hw_liked_users']); // integer array (users id that liked)
                $res_liked_users_count = count($res_liked_users); // integer (like count)
                $resource = [
                    'id'                        => $single_res_data[0]['id'], // integer
                    'title'                     => $single_res_data[0]['title'], // string
                    'url'                       => $single_res_data[0]['url'], // string
                    'location'                  => $single_res_data[0]['location'], // web or local
                    'type'                      => $single_res_data[0]['type'], // doc, pdf, svg, mp4,...
                    'author_id'                 => $single_res_data[0]['author_id'], //integer
                    'post_liked_users_count'    => $res_liked_users_count,
                    'post_liked_users'          => $res_liked_users, // array of user id
                    'state'                     => $single_res_data[0]['state'], // Published, unpublished, awaiting, or draft
                ];
        } else {
            $resource = false;
        }
        // Rendering the data
        // ******************
        return Inertia::render('Singleresource', [
            'resources' => $resource
        ]);   

    }

    public function edit_single($post_id) {
        $single_post_data = Resource::where('id', '=', $post_id)->get();
        // get some datas from DB and format some others...
        
        $post = [
            'id'                 => $single_post_data[0]['id'], // integer
            'title'              => $single_post_data[0]['title'], // text
            'url'                => $single_post_data[0]['url'], // text
            'state'              => $single_post_data[0]['state'] // Published, unpublished, awaiting, or draft
        ];
        
        // Rendering the data
        // ******************
        return Inertia::render('Singleresourceedit', [
            'resource' => $post
        ]);   
    }

    public function update_single(Request $request, string $id) {
        $res = Resource::find($id);
        $res->title = $request->title;
        $res->url = $request->url;
        $res->state = $request->state;
        $res->update();
        return to_route('resources');
    }

    public function create_single() {
        return Inertia::render('Singleresourcecreate');   
    }

    public function store_new_single(Request $request) {
        $user_id = auth()->user()->id;
        $res = new Resource;
        $res->author_id = $user_id;
        $res->title = $request->title;
        $res->url = $request->url;
        $res->state = $request->state;
        $res->save();
        return to_route('resources');
    }
}
