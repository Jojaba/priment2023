<?php

namespace App\Http\Controllers;
use App\Models\Talk;
use Inertia\Inertia;
//use Illuminate\Http\Request;

class TalksController extends Controller
{
    public function show() {
        // Get the talks data and handle them before rendering
        // ***************************************************
        $user_id = auth()->user()->id;
        // only get the users talks (as author or recipient)
        $all_users_talks = Talk::where('author_id', '=', $user_id)
                                    ->orWhere('recipients_id', '=', $user_id)
                                    ->orWhere('recipients_id', 'LIKE', $user_id.',%')
                                    ->orWhere('recipients_id', 'LIKE', '%,'.$user_id.',%')
                                    ->orderBy('updated_at', 'desc') // Ordered by updated date
                                    ->get();
        if(count($all_users_talks) > 0) {
            foreach($all_users_talks as $talk) {
                // Data treatment
                $recipients_id_array = explode(',', $talk->recipients_id);
                $date = date ("d/m/Y", strtotime($talk->updated_at)); // Date format :  dd/mm/yyyy
                $time = date ("H\hi", strtotime($talk->updated_at)); // Time format :  hh\hmm
                // Building talk item
                $talks[] = [
                    'id'                        => $talk->id, // integer
                    'subject'                   => $talk->subject, // string
                    'author_id'                 => $talk->author_id, //integer
                    'recipients_id'             => $recipients_id_array, // array of recipients id
                    'content'                   => $talk->content, // text
                    'date'                      => $date,
                    'time'                      => $time
                ];
            }
            
        } else {
            $talks = false;
        }
        // Rendering the data
        // ******************
        return Inertia::render('Talks', [
            'talks' => $talks
        ]);
    }
}
