<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            $tickets = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
        } else {
            $tickets = Auth::user()->tickets()->latest()->paginate(10);
        }
        return view('support.index', compact('tickets'));
    }

    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject'  => 'required|string|max:255',
            'message'  => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        Ticket::create([
            'user_id'  => Auth::id(),
            'subject'  => $request->subject,
            'message'  => $request->message,
            'priority' => $request->priority,
            'status'   => 'open',
        ]);

        return redirect()->route('support.index')
            ->with('success', 'আপনার সাপোর্ট টিকিট সফলভাবে জমা হয়েছে!');
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }
        $replies = $ticket->replies()->orderBy('created_at')->get();
        return view('support.show', compact('ticket', 'replies'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['message' => 'required|string']);

        $ticket->replies()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_admin' => false,
        ]);

        // Reopen if closed
        if ($ticket->status === 'closed') {
            $ticket->update(['status' => 'open']);
        }

        return redirect()->route('support.show', $ticket)
            ->with('success', 'আপনার রিপ্লাই পাঠানো হয়েছে!');
    }
}
