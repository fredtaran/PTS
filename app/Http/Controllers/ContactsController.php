<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    /**
     * Landing page
     */
    public function index(){
        return view('chat');
    }

    /**
     * Get contacts for chat
     */
    public function get()
    {
        $user = Auth::user();
        $picture = asset('img/receiver.png');
        // get all users except the authenticated one
        if($user->level == 'opcen') {
            $contacts = User::
                    select(
                    "users.id",
                    DB::raw("'$picture' as picture"),
                    DB::raw("if(
                            users.level = 'doctor', concat('Dr. ', users.fname, ' ', users.lname), concat(users.fname, ' ', users.lname)
                        ) as name"),
                    "facility.name as facility",
                    "users.contact"
                )
                ->leftJoin("facility", "facility.id", "=", "users.facility_id")
                ->where('users.id', '!=', Auth::user()->id)
                ->where('users.level', '=', 'opcen')
                ->orderBy('users.fname', 'desc')
                ->get();
        } else if ($user->level == 'doctor' || $user->level == 'support' || $user->level == 'admin') {
            $contacts = User::
                select(
                    "users.id",
                    DB::raw("'$picture' as picture"),
                    DB::raw("if(
                        users.level = 'doctor',concat('Dr. ', users.fname, ' ', users.lname), concat(users.fname, ' ', users.lname)
                    ) as name"),
                    "facility.name as facility",
                    "users.contact"
                )
                ->leftJoin("facility", "facility.id", "=", "users.facility_id")
                ->where('users.id', '!=', Auth::user()->id)
                ->where(function($q) {
                    $q->where('users.level', '=', 'doctor');
                    $q->orWhere('users.level', '=', 'support');
                    $q->orWhere('users.level', '=', 'admin');
                })
                ->orderBy('users.fname', 'desc')
                ->get();
        }

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', Auth::user()->id)
            ->where('read', false)
            ->groupBy('from')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });


        return response()->json($contacts);
    }

    /**
     * Get conversation
     */
    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', Auth::user()->id)->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            $q->where('from', Auth::user()->id);
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', Auth::user()->id);
        })->get();

        return response()->json($messages);
    }

    /**
     * Send message
     */
    public function send(Request $request)
    {
        $message = Message::create([
            'from' => Auth::user()->id,
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return response()->json($message);
    }
}
