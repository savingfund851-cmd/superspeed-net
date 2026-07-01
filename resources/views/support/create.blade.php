<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>নতুন সাপোর্ট টিকিট — SuperSpeed Net</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{--bg:#0a0f1a;--card:rgba(255,255,255,0.04);--border:rgba(255,255,255,0.08);--primary:#0ea5e9;--cyan:#22d3ee;--text:#e2e8f0;--text2:#94a3b8;--text3:#64748b;--danger:#ef4444;}
body{background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;min-height:100vh;}
.topbar{background:rgba(0,0,0,0.5);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px;position:sticky;top:0;z-index:100;}
.topbar-brand{display:flex;align-items:center;gap:10px;text-decoration:none;}
.topbar-brand img{width:36px;height:36px;border-radius:8px;}
.topbar-brand span{font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700;color:var(--text);}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:all 0.2s;border:none;text-decoration:none;}
.btn-primary{background:linear-gradient(135deg,var(--primary),#0284c7);color:#fff;}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(14,165,233,0.3);}
.btn-glass{background:rgba(255,255,255,0.05);border:1px solid var(--border);color:var(--text2);}
.container{max-width:720px;margin:0 auto;padding:0 24px;}
.page-hero{padding:56px 0 32px;}
.page-hero h1{font-family:'Space Grotesk',sans-serif;font-size:32px;font-weight:800;margin-bottom:8px;}
.page-hero p{color:var(--text2);font-size:15px;}
.form-card{background:var(--card);border:1px solid var(--border);border-radius:20px;padding:36px;}
.form-group{margin-bottom:24px;}
.form-label{display:block;font-size:13px;font-weight:600;color:var(--text2);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;}
.form-control{width:100%;background:rgba(255,255,255,0.04);border:1px solid var(--border);border-radius:10px;padding:12px 16px;color:var(--text);font-family:'Inter',sans-serif;font-size:14px;transition:border-color 0.2s;outline:none;}
.form-control:focus{border-color:rgba(14,165,233,0.4);box-shadow:0 0 0 3px rgba(14,165,233,0.08);}
select.form-control option{background:#1e293b;}
.error{color:var(--danger);font-size:12px;margin-top:6px;}
.priority-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;}
.priority-opt{position:relative;}
.priority-opt input{position:absolute;opacity:0;width:0;height:0;}
.priority-opt label{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:14px 8px;border-radius:12px;border:1px solid var(--border);background:rgba(255,255,255,0.03);cursor:pointer;transition:all 0.2s;font-size:12px;font-weight:600;gap:6px;}
.priority-opt input:checked + label{border-color:rgba(14,165,233,0.4);background:rgba(14,165,233,0.08);color:var(--cyan);}
.priority-icon{font-size:22px;}
</style>
</head>
<body>
<div class="topbar">
    <a href="/" class="topbar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <span>SuperSpeed Net</span>
    </a>
    <div style="display:flex;gap:12px;">
        <a href="{{ route('support.index') }}" class="btn btn-glass">← Back</a>
    </div>
</div>

<div class="container">
    <div class="page-hero">
        <h1>🎫 নতুন সাপোর্ট টিকিট</h1>
        <p>আপনার সমস্যা বিস্তারিত লিখুন। আমরা দ্রুত সমাধান করব।</p>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('support.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">বিষয় (Subject) *</label>
                <input type="text" name="subject" class="form-control" placeholder="যেমন: ইন্টারনেট কানেকশন নেই" value="{{ old('subject') }}" required>
                @error('subject')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">সমস্যার ধরন (Priority) *</label>
                <div class="priority-grid">
                    <div class="priority-opt">
                        <input type="radio" name="priority" id="p_low" value="low" {{ old('priority','medium')==='low'?'checked':'' }}>
                        <label for="p_low"><span class="priority-icon">🟢</span>Low</label>
                    </div>
                    <div class="priority-opt">
                        <input type="radio" name="priority" id="p_medium" value="medium" {{ old('priority','medium')==='medium'?'checked':'' }}>
                        <label for="p_medium"><span class="priority-icon">🔵</span>Medium</label>
                    </div>
                    <div class="priority-opt">
                        <input type="radio" name="priority" id="p_high" value="high" {{ old('priority','medium')==='high'?'checked':'' }}>
                        <label for="p_high"><span class="priority-icon">🟡</span>High</label>
                    </div>
                    <div class="priority-opt">
                        <input type="radio" name="priority" id="p_urgent" value="urgent" {{ old('priority','medium')==='urgent'?'checked':'' }}>
                        <label for="p_urgent"><span class="priority-icon">🔴</span>Urgent</label>
                    </div>
                </div>
                @error('priority')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">বিস্তারিত বিবরণ (Message) *</label>
                <textarea name="message" class="form-control" rows="6" placeholder="আপনার সমস্যা বিস্তারিত লিখুন..." required>{{ old('message') }}</textarea>
                @error('message')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <a href="{{ route('support.index') }}" class="btn btn-glass">বাতিল</a>
                <button type="submit" class="btn btn-primary">🚀 টিকিট জমা দিন</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
