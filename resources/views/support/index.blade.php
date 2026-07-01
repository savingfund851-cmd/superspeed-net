<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Support Tickets — SuperSpeed Net</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
    --bg:#0a0f1a;--card:rgba(255,255,255,0.04);--border:rgba(255,255,255,0.08);
    --primary:#0ea5e9;--cyan:#22d3ee;--text:#e2e8f0;--text2:#94a3b8;--text3:#64748b;
    --success:#10b981;--warning:#f59e0b;--danger:#ef4444;--info:#6366f1;
}
body{background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;min-height:100vh;}
.topbar{background:rgba(0,0,0,0.5);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);
    padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px;position:sticky;top:0;z-index:100;}
.topbar-brand{display:flex;align-items:center;gap:10px;text-decoration:none;}
.topbar-brand img{width:36px;height:36px;border-radius:8px;}
.topbar-brand span{font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700;color:var(--text);}
.topbar-nav{display:flex;align-items:center;gap:20px;}
.topbar-nav a{color:var(--text2);text-decoration:none;font-size:14px;transition:color 0.2s;}
.topbar-nav a:hover{color:var(--cyan);}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:all 0.2s;border:none;text-decoration:none;}
.btn-primary{background:linear-gradient(135deg,var(--primary),#0284c7);color:#fff;}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(14,165,233,0.3);}
.btn-glass{background:rgba(255,255,255,0.05);border:1px solid var(--border);color:var(--text2);}
.btn-glass:hover{border-color:rgba(14,165,233,0.3);color:var(--cyan);}
.container{max-width:1000px;margin:0 auto;padding:0 24px;}
.page-hero{padding:56px 0 40px;text-align:center;}
.page-hero h1{font-family:'Space Grotesk',sans-serif;font-size:36px;font-weight:800;margin-bottom:8px;}
.page-hero p{color:var(--text2);font-size:16px;}
.card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:24px;}
.card + .card{margin-top:16px;}
.ticket-row{display:flex;align-items:center;justify-content:space-between;gap:16px;text-decoration:none;color:inherit;padding:20px 24px;background:var(--card);border:1px solid var(--border);border-radius:14px;transition:all 0.25s;margin-bottom:12px;}
.ticket-row:hover{border-color:rgba(14,165,233,0.3);background:rgba(14,165,233,0.04);transform:translateX(4px);}
.ticket-subject{font-size:15px;font-weight:600;color:var(--text);margin-bottom:4px;}
.ticket-meta{font-size:12px;color:var(--text3);}
.badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:100px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;}
.badge-open{background:rgba(14,165,233,0.1);color:var(--primary);border:1px solid rgba(14,165,233,0.2);}
.badge-inprogress{background:rgba(245,158,11,0.1);color:var(--warning);border:1px solid rgba(245,158,11,0.2);}
.badge-resolved,.badge-closed{background:rgba(16,185,129,0.1);color:var(--success);border:1px solid rgba(16,185,129,0.2);}
.badge-low{background:rgba(100,116,139,0.1);color:var(--text3);}
.badge-medium{background:rgba(14,165,233,0.1);color:var(--primary);}
.badge-high{background:rgba(245,158,11,0.1);color:var(--warning);}
.badge-urgent{background:rgba(239,68,68,0.1);color:var(--danger);}
.empty-state{text-align:center;padding:80px 24px;color:var(--text3);}
.empty-state .icon{font-size:64px;margin-bottom:16px;}
.empty-state h3{font-size:20px;font-weight:700;color:var(--text2);margin-bottom:8px;}
.alert{padding:14px 18px;border-radius:10px;font-size:14px;margin-bottom:20px;}
.alert-success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:var(--success);}
</style>
</head>
<body>
<div class="topbar">
    <a href="/" class="topbar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <span>SuperSpeed Net</span>
    </a>
    <div class="topbar-nav">
        <a href="/">🏠 Home</a>
        @auth
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="btn btn-glass" style="cursor:pointer">Logout</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn btn-glass">Login</a>
        @endauth
    </div>
</div>

<div class="container">
    <div class="page-hero">
        <h1>🎫 Support Tickets</h1>
        <p>আপনার সমস্যা জানান। আমাদের NOC টিম দ্রুত সমাধান দেবে।</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <h2 style="font-size:18px;font-weight:700;">আমার টিকিটসমূহ ({{ $tickets->total() }})</h2>
        @auth
        <a href="{{ route('support.create') }}" class="btn btn-primary">+ নতুন টিকিট</a>
        @else
        <a href="{{ route('support.create') }}" class="btn btn-primary">+ নতুন টিকিট (Login করুন)</a>
        @endauth
    </div>

    @auth
        @forelse($tickets as $ticket)
        <a href="{{ route('support.show', $ticket) }}" class="ticket-row">
            <div>
                <div class="ticket-subject">{{ $ticket->subject }}</div>
                <div class="ticket-meta">#{{ $ticket->id }} · {{ $ticket->created_at->diffForHumans() }} · {{ $ticket->replies->count() }} reply</div>
            </div>
            <div style="display:flex;gap:8px;align-items:center;flex-shrink:0;">
                <span class="badge badge-{{ $ticket->priority }}">{{ ucfirst($ticket->priority) }}</span>
                <span class="badge badge-{{ str_replace(' ','',$ticket->status) }}">{{ ucfirst($ticket->status) }}</span>
            </div>
        </a>
        @empty
        <div class="empty-state">
            <div class="icon">📭</div>
            <h3>কোনো টিকিট নেই</h3>
            <p>আপনার কোনো সমস্যা হলে নতুন টিকিট খুলুন।</p>
            <a href="{{ route('support.create') }}" class="btn btn-primary" style="margin-top:16px;display:inline-flex;">+ নতুন টিকিট</a>
        </div>
        @endforelse
        {{ $tickets->links() }}
    @else
    <div class="empty-state">
        <div class="icon">🔒</div>
        <h3>Login করুন</h3>
        <p>টিকিট দেখতে বা খুলতে প্রথমে লগইন করতে হবে।</p>
        <a href="{{ route('support.create') }}" class="btn btn-primary" style="margin-top:16px;display:inline-flex;">Login করে টিকিট খুলুন</a>
    </div>
    @endauth
</div>
</body>
</html>
