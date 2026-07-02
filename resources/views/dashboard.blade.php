<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <style>
        :root{--primary:#0ea5e9;--cyan:#22d3ee;--text:#e2e8f0;--text2:#94a3b8;--text3:#64748b;
            --card:rgba(255,255,255,0.04);--border:rgba(255,255,255,0.08);--success:#10b981;--warning:#f59e0b;--danger:#ef4444;}
        .dash-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-bottom:28px;}
        .stat-card{
            background:var(--card);border:1px solid var(--border);border-radius:16px;padding:22px;
            position:relative;overflow:hidden;transition:transform 0.25s,border-color 0.25s;
        }
        .stat-card:hover{transform:translateY(-3px);border-color:rgba(14,165,233,0.3);}
        .stat-card::before{content:'';position:absolute;top:0;right:0;width:60px;height:60px;
            border-radius:50%;filter:blur(30px);opacity:0.4;}
        .stat-card.blue::before{background:var(--primary);}
        .stat-card.cyan::before{background:var(--cyan);}
        .stat-card.green::before{background:var(--success);}
        .stat-card.orange::before{background:var(--warning);}
        .stat-icon{font-size:24px;margin-bottom:10px;}
        .stat-val{font-family:'Space Grotesk',sans-serif;font-size:26px;font-weight:800;color:var(--text);}
        .stat-lbl{font-size:12px;color:var(--text3);margin-top:3px;font-weight:500;}
        /* Section cards */
        .section-card{background:var(--card);border:1px solid var(--border);border-radius:18px;padding:24px;margin-bottom:20px;}
        .section-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
        .section-title{font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:700;color:var(--text);}
        /* Customer Info Card */
        .info-card{
            background:linear-gradient(135deg,rgba(14,165,233,0.08),rgba(34,211,238,0.04));
            border:1px solid rgba(14,165,233,0.2);border-radius:18px;padding:24px;
            margin-bottom:20px;position:relative;overflow:hidden;
        }
        .info-card::after{content:'⚡';position:absolute;right:24px;top:16px;font-size:48px;opacity:0.08;}
        .info-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px;margin-top:16px;}
        .info-item{}
        .info-label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--text3);margin-bottom:4px;}
        .info-value{font-size:15px;font-weight:700;color:var(--text);}
        /* Package card */
        .pkg-hero{
            background:linear-gradient(135deg,rgba(14,165,233,0.12),rgba(99,102,241,0.08));
            border:1px solid rgba(14,165,233,0.25);border-radius:16px;padding:24px;
            display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;
        }
        .pkg-speed{font-family:'Space Grotesk',sans-serif;font-size:48px;font-weight:900;
            background:linear-gradient(135deg,var(--primary),var(--cyan));-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
        .pkg-unit{font-size:18px;font-weight:600;color:var(--text2);}
        .badge{display:inline-flex;align-items:center;padding:4px 12px;border-radius:100px;font-size:11px;font-weight:700;text-transform:uppercase;}
        .badge-active{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:var(--success);}
        .badge-unpaid{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:var(--danger);}
        .btn-pay{
            display:inline-flex;align-items:center;gap:8px;padding:12px 24px;border-radius:10px;
            background:linear-gradient(135deg,var(--primary),#0284c7);color:#fff;
            font-size:14px;font-weight:700;border:none;cursor:pointer;text-decoration:none;
            transition:all 0.2s;
        }
        .btn-pay:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(14,165,233,0.35);}
        /* Payment table */
        .pay-table{width:100%;border-collapse:collapse;}
        .pay-table th{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--text3);padding:10px 14px;text-align:left;border-bottom:1px solid var(--border);}
        .pay-table td{padding:13px 14px;font-size:13px;color:var(--text2);border-bottom:1px solid rgba(255,255,255,0.03);}
        .pay-table tr:last-child td{border-bottom:none;}
        .pay-table tr:hover td{background:rgba(255,255,255,0.02);}
        /* Ticket row */
        .ticket-row{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;
            border:1px solid var(--border);border-radius:12px;text-decoration:none;color:inherit;
            transition:all 0.2s;margin-bottom:8px;}
        .ticket-row:hover{border-color:rgba(14,165,233,0.3);background:rgba(14,165,233,0.03);transform:translateX(4px);}
        .t-subject{font-size:14px;font-weight:600;color:var(--text);}
        .t-meta{font-size:12px;color:var(--text3);margin-top:2px;}
        .pbadge{padding:3px 10px;border-radius:100px;font-size:10px;font-weight:700;text-transform:uppercase;}
        .p-low{background:rgba(16,185,129,0.1);color:var(--success);}
        .p-medium{background:rgba(14,165,233,0.1);color:var(--primary);}
        .p-high{background:rgba(245,158,11,0.1);color:var(--warning);}
        .p-urgent{background:rgba(239,68,68,0.1);color:var(--danger);}
        .s-open{background:rgba(14,165,233,0.1);color:var(--primary);}
        .s-in_progress{background:rgba(245,158,11,0.1);color:var(--warning);}
        .s-resolved,.s-closed{background:rgba(16,185,129,0.1);color:var(--success);}
        /* Animated counter */
        @keyframes countUp{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
        .stat-val{animation:countUp 0.5s ease forwards;}
        .btn-sm{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;transition:all 0.2s;cursor:pointer;border:none;}
        .btn-primary-sm{background:linear-gradient(135deg,var(--primary),#0284c7);color:#fff;}
        .btn-primary-sm:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(14,165,233,0.3);}
    </style>

    @php $user = Auth::user(); @endphp

    {{-- ── Customer Profile Card (Premium) ── --}}
    <style>
        .profile-hero {
            position: relative; overflow: hidden; border-radius: 24px; margin-bottom: 24px;
            background: linear-gradient(135deg, rgba(14,165,233,0.12) 0%, rgba(99,102,241,0.10) 50%, rgba(34,211,238,0.08) 100%);
            border: 1px solid rgba(14,165,233,0.25);
            padding: 0;
        }
        .profile-hero::before {
            content: ''; position: absolute; top: -60px; right: -60px;
            width: 250px; height: 250px; border-radius: 50%;
            background: radial-gradient(circle, rgba(14,165,233,0.15), transparent 70%);
            pointer-events: none;
        }
        .profile-hero::after {
            content: ''; position: absolute; bottom: -40px; left: 30%;
            width: 180px; height: 180px; border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.10), transparent 70%);
            pointer-events: none;
        }
        .profile-banner {
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--cyan), #6366f1, var(--primary));
            background-size: 200% 100%;
            animation: bannerMove 3s linear infinite;
        }
        @keyframes bannerMove { 0%{background-position:0% 0%} 100%{background-position:200% 0%} }
        .profile-body { padding: 28px 32px 32px; position: relative; z-index: 2; }
        .profile-top { display: flex; align-items: center; gap: 20px; margin-bottom: 24px; }
        .profile-avatar {
            width: 72px; height: 72px; border-radius: 50%; flex-shrink: 0;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; font-weight: 900; color: #fff;
            box-shadow: 0 0 30px rgba(14,165,233,0.4), 0 0 0 4px rgba(14,165,233,0.15);
        }
        .profile-name-block { flex: 1; }
        .profile-name { font-family:'Space Grotesk',sans-serif; font-size: 24px; font-weight: 800; color: var(--text); margin-bottom: 4px; }
        .profile-role { display: inline-flex; align-items: center; gap: 6px; padding: 4px 14px; border-radius: 100px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.25); color: var(--success); }
        .cust-id-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 8px 20px; border-radius: 12px;
            background: rgba(14,165,233,0.08); border: 1px solid rgba(14,165,233,0.2);
            font-family: 'Space Grotesk', sans-serif; font-size: 20px; font-weight: 800;
            color: var(--cyan); letter-spacing: 1px;
        }
        .cust-id-badge span.label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text3); display: block; }
        .profile-divider { height: 1px; background: var(--border); margin: 0 0 24px; }
        .profile-info-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; }
        .profile-info-item { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 12px; padding: 14px 16px; transition: border-color 0.2s; }
        .profile-info-item:hover { border-color: rgba(14,165,233,0.2); }
        .profile-info-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text3); margin-bottom: 6px; display: flex; align-items: center; gap: 5px; }
        .profile-info-value { font-size: 14px; font-weight: 600; color: var(--text); word-break: break-all; }
    </style>

    <div class="profile-hero">
        <div class="profile-banner"></div>
        <div class="profile-body">
            <div class="profile-top">
                <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div class="profile-name-block">
                    <div class="profile-name">{{ $user->name }}</div>
                    <span class="profile-role">🟢 {{ __('Active Customer') }}</span>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--text3);margin-bottom:6px;">{{ __('Customer ID') }}</div>
                    <div class="cust-id-badge">
                        # {{ $user->customer_id ?? str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>
            <div class="profile-divider"></div>
            <div class="profile-info-grid">
                <div class="profile-info-item">
                    <div class="profile-info-label">📱 {{ __('Mobile') }}</div>
                    <div class="profile-info-value">{{ $user->phone ?? 'N/A' }}</div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">🔑 {{ __('Login ID') }}</div>
                    <div class="profile-info-value" style="color:var(--cyan);">{{ $user->login_id ?? $user->phone ?? 'N/A' }}</div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">✉️ {{ __('Email') }}</div>
                    <div class="profile-info-value" style="font-size:13px;">{{ $user->email ?? 'N/A' }}</div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">📅 {{ __('Member Since') }}</div>
                    <div class="profile-info-value">{{ $user->created_at->format('d M, Y') }}</div>
                </div>
                @if($user->address)
                <div class="profile-info-item" style="grid-column: span 2;">
                    <div class="profile-info-label">📍 {{ __('Address') }}</div>
                    <div class="profile-info-value" style="font-size:13px;">{{ $user->address }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ── Quick Stats ── --}}
    @php
        $ticketCount = $user->tickets()->count();
        $openTickets = $user->tickets()->where('status','open')->count();
        $payCount    = $user->payments()->where('status','completed')->count();
    @endphp
    <div class="dash-grid">
        <div class="stat-card blue">
            <div class="stat-icon">📦</div>
            <div class="stat-val">{{ $subscription ? $subscription->package->speed_mbps.'Mbps' : 'N/A' }}</div>
            <div class="stat-lbl">{{ __('Current Package') }}</div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon">💰</div>
            <div class="stat-val">৳{{ $subscription ? number_format($payableAmount,0) : '—' }}</div>
            <div class="stat-lbl">{{ __('Monthly Bill') }}</div>
        </div>
        <div class="stat-card cyan">
            <div class="stat-icon">🎫</div>
            <div class="stat-val">{{ $ticketCount }}</div>
            <div class="stat-lbl">{{ __('Total Tickets') }}</div>
        </div>
        <div class="stat-card orange">
            <div class="stat-icon">✅</div>
            <div class="stat-val">{{ $payCount }}</div>
            <div class="stat-lbl">{{ __('Paid Invoices') }}</div>
        </div>
    </div>

    {{-- ── Current Package ── --}}
    <div class="section-card">
        <div class="section-head">
            <div class="section-title">🌐 {{ __('Your Internet Package') }}</div>
        </div>
        @if($subscription)
        <div class="pkg-hero">
            <div>
                <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--text3);margin-bottom:6px;">{{ __('Current Plan') }}</div>
                <div style="font-size:22px;font-weight:800;color:var(--text);margin-bottom:6px;">{{ $subscription->package->name }}</div>
                <div class="badge {{ $subscription->status === 'active' ? 'badge-active' : 'badge-unpaid' }}">
                    {{ $subscription->status === 'active' ? '🟢 '.__('Active') : '🔴 '.__('Unpaid') }}
                </div>
                <div style="font-size:12px;color:var(--text3);margin-top:10px;">
                    {{ __('Billing') }}: {{ $subscription->start_date->format('d M, Y') }} → {{ $subscription->end_date->format('d M, Y') }}
                </div>
            </div>
            <div style="text-align:center;">
                <div><span class="pkg-speed">{{ $subscription->package->speed_mbps }}</span><span class="pkg-unit"> {{ __('Mbps') }}</span></div>
                <div style="font-size:12px;color:var(--text3);">{{ __('Dedicated Fiber') }}</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:12px;color:var(--text3);margin-bottom:4px;">{{ __('Monthly Amount') }}</div>
                <div style="font-family:'Space Grotesk',sans-serif;font-size:32px;font-weight:900;color:var(--text);">৳{{ number_format($payableAmount,0) }}</div>
                @if($subscription->status !== 'active')
                <form action="{{ route('payment.pay') }}" method="POST" style="margin-top:12px;">
                    @csrf
                    <button type="submit" class="btn-pay">💳 {{ __('Pay Now') }}</button>
                </form>
                @endif
            </div>
        </div>
        @else
        <div style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.2);border-radius:12px;padding:20px;text-align:center;">
            <div style="font-size:32px;margin-bottom:8px;">📦</div>
            <div style="font-weight:700;color:var(--warning);margin-bottom:4px;">{{ __('No Active Package') }}</div>
            <div style="font-size:13px;color:var(--text3);">{{ __('Open a ticket for new connection.') }}</div>
        </div>
        @endif
    </div>

    {{-- ── Support Tickets ── --}}
    @php $myTickets = $user->tickets()->latest()->take(5)->get(); @endphp
    <div class="section-card">
        <div class="section-head">
            <div class="section-title">🎫 {{ __('Support Tickets') }}</div>
            <a href="{{ route('support.create') }}" class="btn-sm btn-primary-sm">+ {{ __('New Ticket') }}</a>
        </div>
        @forelse($myTickets as $t)
        <a href="{{ route('support.show', $t) }}" class="ticket-row">
            <div>
                <div class="t-subject">{{ $t->subject }}</div>
                <div class="t-meta">#{{ $t->id }} · {{ $t->created_at->diffForHumans() }} · {{ $t->replies->count() }} {{ __('reply') }}</div>
            </div>
            <div style="display:flex;gap:6px;flex-shrink:0;">
                <span class="pbadge p-{{ $t->priority }}">{{ ucfirst($t->priority) }}</span>
                <span class="pbadge s-{{ $t->status }}">{{ ucfirst(str_replace('_',' ',$t->status)) }}</span>
            </div>
        </a>
        @empty
        <div style="text-align:center;padding:32px;color:var(--text3);">
            <div style="font-size:40px;margin-bottom:8px;">📭</div>
            <div style="font-weight:600;margin-bottom:4px;">{{ __('No tickets found') }}</div>
            <a href="{{ route('support.create') }}" style="color:var(--primary);text-decoration:none;font-size:13px;">{{ __('Open your first ticket') }} →</a>
        </div>
        @endforelse
        @if($myTickets->count() >= 5)
        <a href="{{ route('support.index') }}" style="display:block;text-align:center;margin-top:8px;font-size:13px;color:var(--primary);text-decoration:none;padding:8px;">{{ __('View all tickets') }} →</a>
        @endif
    </div>

    {{-- ── Recent Payments ── --}}
    <div class="section-card">
        <div class="section-head">
            <div class="section-title">💳 {{ __('Recent Payments') }}</div>
            <a href="{{ route('quick-pay') }}" class="btn-sm btn-primary-sm">{{ __('Quick Pay') }}</a>
        </div>
        @if($payments->count() > 0)
        <div style="overflow-x:auto;">
            <table class="pay-table">
                <thead>
                    <tr>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Gateway') }}</th>
                        <th>{{ __('Transaction ID') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                    <tr>
                        <td>{{ $p->created_at->format('d M, Y') }}</td>
                        <td style="font-weight:700;color:var(--text);">৳{{ number_format($p->amount,0) }}</td>
                        <td>{{ ucfirst($p->gateway ?? 'N/A') }}</td>
                        <td style="font-size:12px;">{{ $p->transaction_id ?? 'N/A' }}</td>
                        <td>
                            <span class="pbadge {{ $p->status === 'completed' ? 'p-low' : 'p-high' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--text3);font-size:14px;padding:16px 0;">{{ __('No payments found.') }}</p>
        @endif
    </div>
</x-app-layout>
