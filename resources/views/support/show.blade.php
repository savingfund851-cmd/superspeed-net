<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ticket #{{ $ticket->id }} — SuperSpeed Net</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{--bg:#0a0f1a;--card:rgba(255,255,255,0.04);--border:rgba(255,255,255,0.08);--primary:#0ea5e9;--cyan:#22d3ee;--text:#e2e8f0;--text2:#94a3b8;--text3:#64748b;--success:#10b981;--warning:#f59e0b;--danger:#ef4444;}
body{background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;min-height:100vh;}
.topbar{background:rgba(0,0,0,0.5);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px;position:sticky;top:0;z-index:100;}
.topbar-brand{display:flex;align-items:center;gap:10px;text-decoration:none;}
.topbar-brand img{width:36px;height:36px;border-radius:8px;}
.topbar-brand span{font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700;color:var(--text);}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:all 0.2s;border:none;text-decoration:none;}
.btn-primary{background:linear-gradient(135deg,var(--primary),#0284c7);color:#fff;}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(14,165,233,0.3);}
.btn-glass{background:rgba(255,255,255,0.05);border:1px solid var(--border);color:var(--text2);}
.container{max-width:800px;margin:0 auto;padding:0 24px;}
.ticket-header{padding:40px 0 24px;}
.ticket-header h1{font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:800;margin-bottom:10px;}
.meta-row{display:flex;gap:10px;flex-wrap:wrap;align-items:center;}
.badge{display:inline-flex;align-items:center;padding:4px 12px;border-radius:100px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;}
.badge-open{background:rgba(14,165,233,0.1);color:var(--primary);border:1px solid rgba(14,165,233,0.2);}
.badge-inprogress{background:rgba(245,158,11,0.1);color:var(--warning);border:1px solid rgba(245,158,11,0.2);}
.badge-resolved,.badge-closed{background:rgba(16,185,129,0.1);color:var(--success);border:1px solid rgba(16,185,129,0.2);}
.badge-low{background:rgba(100,116,139,0.1);color:var(--text3);border:1px solid rgba(100,116,139,0.2);}
.badge-medium{background:rgba(14,165,233,0.1);color:var(--primary);border:1px solid rgba(14,165,233,0.2);}
.badge-high{background:rgba(245,158,11,0.1);color:var(--warning);border:1px solid rgba(245,158,11,0.2);}
.badge-urgent{background:rgba(239,68,68,0.1);color:var(--danger);border:1px solid rgba(239,68,68,0.2);}
/* Messages */
.msg-list{display:flex;flex-direction:column;gap:16px;margin-bottom:32px;}
.msg{display:flex;gap:14px;align-items:flex-start;}
.msg.admin{flex-direction:row-reverse;}
.msg-avatar{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;border:1px solid var(--border);}
.msg.customer .msg-avatar{background:rgba(14,165,233,0.1);}
.msg.admin .msg-avatar{background:rgba(16,185,129,0.1);}
.msg-bubble{max-width:75%;padding:16px 20px;border-radius:16px;font-size:14px;line-height:1.7;}
.msg.customer .msg-bubble{background:rgba(14,165,233,0.07);border:1px solid rgba(14,165,233,0.15);border-radius:4px 16px 16px 16px;}
.msg.admin .msg-bubble{background:rgba(16,185,129,0.07);border:1px solid rgba(16,185,129,0.15);border-radius:16px 4px 16px 16px;}
.msg-time{font-size:11px;color:var(--text3);margin-top:6px;}
.msg.admin .msg-time{text-align:right;}
/* Original message */
.orig-msg{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:24px;margin-bottom:24px;}
.orig-msg h3{font-size:13px;font-weight:600;color:var(--text3);text-transform:uppercase;letter-spacing:1px;margin-bottom:12px;}
.orig-msg p{font-size:15px;line-height:1.8;color:var(--text2);}
/* Reply */
.reply-box{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:24px;}
.reply-box h3{font-size:16px;font-weight:700;margin-bottom:16px;}
.form-control{width:100%;background:rgba(255,255,255,0.04);border:1px solid var(--border);border-radius:10px;padding:12px 16px;color:var(--text);font-family:'Inter',sans-serif;font-size:14px;transition:border-color 0.2s;outline:none;resize:vertical;}
.form-control:focus{border-color:rgba(14,165,233,0.4);}
.alert{padding:12px 18px;border-radius:10px;font-size:14px;margin-bottom:16px;}
.alert-success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:var(--success);}
</style>
</head>
<body>
<div class="topbar">
    <a href="/" class="topbar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <span>SuperSpeed Net</span>
    </a>
    <a href="{{ route('support.index') }}" class="btn btn-glass">← সব টিকিট</a>
</div>

<div class="container">
    <div class="ticket-header">
        <h1>🎫 {{ $ticket->subject }}</h1>
        <div class="meta-row">
            <span style="color:var(--text3);font-size:13px;">#{{ $ticket->id }}</span>
            <span class="badge badge-{{ str_replace(' ','',$ticket->status) }}">{{ ucfirst($ticket->status) }}</span>
            <span class="badge badge-{{ $ticket->priority }}">{{ ucfirst($ticket->priority) }}</span>
            <span style="color:var(--text3);font-size:12px;">{{ $ticket->created_at->format('d M Y, h:i A') }}</span>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <!-- Original Message -->
    <div class="orig-msg">
        <h3>📝 আপনার বার্তা</h3>
        <p>{{ $ticket->message }}</p>
    </div>

    <!-- Reply Thread -->
    @if($replies->count() > 0)
    <div class="msg-list">
        @foreach($replies as $reply)
        <div class="msg {{ $reply->is_admin ? 'admin' : 'customer' }}">
            <div class="msg-avatar">{{ $reply->is_admin ? '🛡️' : '👤' }}</div>
            <div>
                <div style="font-size:12px;font-weight:600;color:var(--text3);margin-bottom:6px;">
                    {{ $reply->is_admin ? 'Support Team' : $reply->user->name }}
                </div>
                <div class="msg-bubble">{{ $reply->message }}</div>
                <div class="msg-time">{{ $reply->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Reply Form -->
    @if(!in_array($ticket->status, ['closed']))
    <div class="reply-box">
        <h3>💬 রিপ্লাই করুন</h3>
        <form method="POST" action="{{ route('support.reply', $ticket) }}">
            @csrf
            <textarea name="message" class="form-control" rows="4" placeholder="আপনার বার্তা লিখুন..." required></textarea>
            @error('message')<div style="color:var(--danger);font-size:12px;margin-top:6px;">{{ $message }}</div>@enderror
            <div style="margin-top:16px;display:flex;justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">📨 রিপ্লাই পাঠান</button>
            </div>
        </form>
    </div>
    @else
    <div style="text-align:center;padding:40px;color:var(--text3);">
        <div style="font-size:32px;margin-bottom:8px;">🔒</div>
        <p>এই টিকিটটি বন্ধ করা হয়েছে।</p>
    </div>
    @endif
</div>
</body>
</html>
