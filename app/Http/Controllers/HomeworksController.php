<?php

namespace App\Http\Controllers;
use App\Models\Homework;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeworksController extends Controller
{
    public function show_all() {
        // Get the homeworks data and handle them before rendering
        // *******************************************************
        $user_id = auth()->user()->id; // string
        $user_identity = auth()->user()->identity; // student, teacher, ...
        if($user_identity == 'teacher' || $user_identity == 'admin') {
            // Get all homeworks
            $all_homeworks = Homework::where('id', '>', 0)->orderBy('date', 'desc')->orderBy('time', 'desc')->get(); // Ordered by date and time
        } else {
            // Get only published homeworks
            $all_homeworks = Homework::where('state', '=', 'published')->orderBy('date', 'desc')->orderBy('time', 'desc')->get(); // Ordered by date and time
        }
        if(count($all_homeworks) > 0) {
            foreach($all_homeworks as $homework) {
                // The published homeworks are visible for all connected users
                // Converting some values before generating the homework datas
                $hw_date_array = explode('-', $homework->date);
                $hw_date = $hw_date_array[2].'/'.$hw_date_array[1].'/'.$hw_date_array[0];
                $hw_time_array = explode(':', $homework->time);
                $hw_time = $hw_time_array[0].'H'.$hw_time_array[1];
                // data about author
                $author_id = $homework->author_id;
                $author_data = USER::where('id', '=', $author_id);
                $author_forename = $author_data->value('forename');
                $author_name = $author_data->value('name');
                $author_display_name = $author_forename.' '.$author_name;
                $hw_liked_users = explode(',', $homework->hw_liked_users); // integer array (users id that liked)
                $hw_liked_users_count = count($hw_liked_users); // integer (like count)
                // homework element array
                $updated_at = date ("d/m/Y", strtotime($homework->updated_at));
                $homeworks[] = [
                    'id'                        => $homework->id, // integer
                    'title'                     => $homework->title, // string
                    'classroom'                 => $homework->classroom, // string
                    'date'                      => $hw_date, // dd/mm/yyyy
                    'time'                      => $hw_time, // hhHmm
                    'author_id'                 => $homework->author_id, //integer
                    'content'                   => $homework->content, // text
                    'associated_res'            => $homework->associated_res, // integer
                    'post_liked_users_count'    => $hw_liked_users_count,
                    'post_liked_users'          => $hw_liked_users, // array of user id
                    'state'                     => $homework->state, // Published, unpublished, awaiting, or draft
                    'author_display_name'       => $author_display_name, // Forename and name of author
                    'updated_at'                => $updated_at // Date format :  dd/mm/yyyy
                ];
            }
        } else {
            $homeworks = false;
        }
        // Rendering the data
        // ******************
        return Inertia::render('Homeworks', [
            'homeworks' => $homeworks
        ]);
    }

    public function show_single($post_id) {
        $single_post_data = Homework::where('id', '=', $post_id)->get();
        if(count($single_post_data) > 0) {
            // get some datas from DB and format some others...
            $post_liked_users = explode(',', $single_post_data[0]['post_liked_users']);
            $post_liked_users_count = count($post_liked_users);
            $updated_at = date ("d/m/Y", strtotime($single_post_data[0]['updated_at']));
            $content = $single_post_data[0]['content'];
            $hw_date_array = explode('-', $single_post_data[0]['date']);
            $hw_date = $hw_date_array[2].'/'.$hw_date_array[1].'/'.$hw_date_array[0];
            $hw_time_array = explode(':', $single_post_data[0]['time']);
            $hw_time = $hw_time_array[0].'H'.$hw_time_array[1];
                
            // data about author
            $author_id = $single_post_data[0]['author_id'];
            $author_data = USER::where('id', '=', $author_id);
            $author_forename = $author_data->value('forename');
            $author_name = $author_data->value('name');
            $author_display_name = $author_forename.' '.$author_name;
            $post = [
                'id'                        => $single_post_data[0]['id'], // integer
                'classroom'                 => $single_post_data[0]['classroom'], // string
                'date'                      => $hw_date, // dd/mm/yyyy
                'time'                      => $hw_time, // hhHmm
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
        return Inertia::render('Singlehomework', [
            'post' => $post
        ]);   
    }

    public function edit_single($post_id) {
        $single_post_data = Homework::where('id', '=', $post_id)->get();
        // get some datas from DB and format some others...
        $hw_date_array = explode('-', $single_post_data[0]['date']);
        $hw_date = $hw_date_array[2].'/'.$hw_date_array[1].'/'.$hw_date_array[0];
        $hw_time_array = explode(':', $single_post_data[0]['time']);
        $hw_time = $hw_time_array[0].'H'.$hw_time_array[1];
        $post = [
            'id'                        => $single_post_data[0]['id'], // integer
            'classroom'                 => $single_post_data[0]['classroom'], // text
            'date'                      => $hw_date,
            'time'                      => $hw_time,
            'content'                   => $single_post_data[0]['content'], // text
            'associated_res'            => $single_post_data[0]['associated_res'], // integer
            'state'                     => $single_post_data[0]['state'] // Published, unpublished, awaiting, or draft
        ];
        
        // Rendering the data
        // ******************
        return Inertia::render('Singlehomeworkedit', [
            'post' => $post
        ]);   
    }

    public function update_single(Request $request, string $id) {
        // Formatting date and time for BDD
        $date_array = explode('/',$request->date);
        $bdd_date = $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
        $bdd_time = str_replace('H', ':', $request->time);
        $hw = Homework::find($id);
        $hw->date = $bdd_date;
        $hw->time = $bdd_time;
        $hw->classroom = $request->classroom;
        $hw->content = $request->content;
        $hw->associated_res = $request->associated_res;
        $hw->state = $request->state;
        $hw->update();
        return to_route('homeworks');
    }

    public function create_single() {
        return Inertia::render('Singlehomeworkcreate');   
    }

    public function store_new_single(Request $request) {
        // Formatting date and time for BDD
        $date_array = explode('/',$request->date);
        $bdd_date = $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
        $bdd_time = str_replace('H', ':', $request->time);
        $user_id = auth()->user()->id;
        $hw = new Homework;
        $hw->author_id = $user_id;
        $hw->date = $bdd_date;
        $hw->time = $bdd_time;
        $hw->classroom = $request->classroom;
        $hw->content = $request->content;
        $hw->associated_res = $request->associated_res;
        $hw->state = $request->state;
        $hw->save();
        return to_route('homeworks');
    }
}
