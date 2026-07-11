<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SuperSpeed Net — Bangladesh's fastest dedicated fiber internet. BTRC approved packages from ৳500/month.">
    <title>SuperSpeed Net — Lightning Fast Fiber Internet</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ═══════════════════════════════════════════
           CSS CUSTOM PROPERTIES
           ═══════════════════════════════════════════ */
        :root {
            --primary: #0ea5e9;
            --primary-light: #38bdf8;
            --primary-dark: #0284c7;
            --accent: #06b6d4;
            --accent2: #6366f1;
            --accent3: #8b5cf6;
            --neon-cyan: #22d3ee;
            --neon-blue: #3b82f6;
            --bg-deep: #020817;
            --bg-surface: rgba(255,255,255,0.03);
            --glass-bg: rgba(255,255,255,0.06);
            --glass-border: rgba(255,255,255,0.1);
            --glass-highlight: rgba(255,255,255,0.15);
            --text-primary: #f0f9ff;
            --text-secondary: #94a3b8;
            --text-tertiary: #64748b;
            --success: #10b981;
            --radius: 20px;
            --radius-sm: 12px;
            --radius-xs: 8px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg-deep);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 2; }

        /* ═══════════════════════════════════════════
           ANIMATED BACKGROUND — MESH GRADIENT + PARTICLES
           ═══════════════════════════════════════════ */
        .bg-scene { position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; }

        .mesh-gradient {
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(14,165,233,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 30%, rgba(99,102,241,0.10) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 80%, rgba(6,182,212,0.08) 0%, transparent 50%),
                radial-gradient(ellipse 90% 70% at 60% 50%, rgba(139,92,246,0.06) 0%, transparent 60%);
            animation: meshShift 12s ease-in-out infinite alternate;
        }
        @keyframes meshShift {
            0% { filter: hue-rotate(0deg); transform: scale(1); }
            50% { filter: hue-rotate(15deg); transform: scale(1.02); }
            100% { filter: hue-rotate(-10deg); transform: scale(1); }
        }

        .grid-overlay {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(14,165,233,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14,165,233,0.035) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(ellipse 80% 70% at 50% 30%, black 20%, transparent 70%);
            animation: gridFloat 30s linear infinite;
        }
        @keyframes gridFloat { 0% { transform: translateY(0); } 100% { transform: translateY(80px); } }

        /* Floating Orbs */
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(80px); opacity: 0.5;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }
        .orb-1 { width: 500px; height: 500px; background: rgba(14,165,233,0.2); top: -10%; left: -5%; animation: orbFloat1 10s; }
        .orb-2 { width: 400px; height: 400px; background: rgba(99,102,241,0.15); top: 30%; right: -8%; animation: orbFloat2 14s; }
        .orb-3 { width: 350px; height: 350px; background: rgba(6,182,212,0.12); bottom: 10%; left: 15%; animation: orbFloat3 12s; }
        @keyframes orbFloat1 { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(40px,30px) scale(1.1)} }
        @keyframes orbFloat2 { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(-30px,40px) scale(0.9)} }
        @keyframes orbFloat3 { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(25px,-35px) scale(1.05)} }

        /* Particle Canvas */
        #particleCanvas { position: absolute; inset: 0; z-index: 1; }

        /* ═══════════════════════════════════════════
           PREMIUM NAVBAR — CENTERED DESIGN
           ═══════════════════════════════════════════ */
        .glass-nav {
            position: fixed; top: 14px; left: 50%; transform: translateX(-50%);
            width: calc(100% - 32px); max-width: 1280px; z-index: 9000;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 0;
            background: rgba(8, 16, 34, 0.82);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 22px;
            backdrop-filter: blur(28px) saturate(200%);
            -webkit-backdrop-filter: blur(28px) saturate(200%);
            padding: 10px 20px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 32px rgba(0,0,0,0.35), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        .glass-nav.scrolled {
            background: rgba(5, 12, 28, 0.96);
            box-shadow: 0 12px 40px rgba(0,0,0,0.55), inset 0 1px 0 rgba(255,255,255,0.07);
            top: 8px;
        }

        /* Logo / Brand */
        .nav-logo-link {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
            padding: 4px 8px 4px 4px;
            border-radius: 14px;
            transition: background 0.25s;
            flex-shrink: 0;
        }
        .nav-logo-link:hover { background: rgba(255,255,255,0.07); }
        .nav-logo-img {
            width: 42px; height: 42px; border-radius: 12px; object-fit: cover;
            mix-blend-mode: lighten;
            filter: drop-shadow(0 0 8px rgba(34,211,238,0.7));
            transition: filter 0.3s, transform 0.3s;
            animation: navLogoFloat 5s ease-in-out infinite;
        }
        .nav-logo-link:hover .nav-logo-img {
            filter: drop-shadow(0 0 16px rgba(34,211,238,1));
        }
        @keyframes navLogoFloat {
            0%,100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }
        .nav-brand {
            display: flex; align-items: center; gap: 7px;
        }
        .nb-lines {
            display: flex; flex-direction: column; gap: 3px; justify-content: center;
        }
        .nb-lines span {
            display: block; height: 2px; border-radius: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan));
            animation: nbLinesSlide 3s ease-in-out infinite;
        }
        .nb-lines span:nth-child(1) { width: 18px; animation-delay: 0s; }
        .nb-lines span:nth-child(2) { width: 12px; animation-delay: 0.05s; }
        .nb-lines span:nth-child(3) { width: 8px; animation-delay: 0.1s; }
        @keyframes nbLinesSlide {
            0%,100% { opacity: 1; transform: translateX(0); }
            50% { opacity: 0.5; transform: translateX(3px); }
        }
        .nb-stack { display: flex; flex-direction: column; line-height: 1.05; }
        .nb-super, .nb-speed {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 7px; font-weight: 700; letter-spacing: 0.12em;
            color: rgba(255,255,255,0.6); text-transform: uppercase;
        }
        .nb-network {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 19px; font-weight: 900; letter-spacing: -0.01em; line-height: 1;
            background: linear-gradient(90deg, #fff 0%, var(--neon-cyan) 60%, #fff 100%);
            background-size: 200%;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: brandShimmer 3.5s linear infinite;
        }
        @keyframes brandShimmer {
            0% { background-position: 100% center; }
            100% { background-position: -100% center; }
        }

        /* Center Links */
        .nav-links-group {
            display: flex; align-items: center; gap: 2px; flex-wrap: nowrap;
            justify-content: center;
            position: relative;
            overflow: visible;
        }
        .nav-link {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            padding: 7px 13px;
            border-radius: 10px;
            font-size: 13.5px; font-weight: 500;
            font-family: 'Inter', sans-serif;
            transition: color 0.2s, background 0.2s;
            white-space: nowrap;
            position: relative;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.09);
        }
        .nav-link:active { transform: scale(0.96); }

        /* Nav Pill (hover indicator) */
        .nav-pill {
            position: absolute; height: 100%; top: 0; left: 0;
            background: rgba(255,255,255,0.06);
            border-radius: 10px; pointer-events: none;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            opacity: 0;
            z-index: -1;
        }

        /* Right side actions */
        .nav-actions {
            display: flex; align-items: center; gap: 10px;
            flex-shrink: 0;
        }
        .nav-cta {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent2) 100%);
            color: #fff !important; font-size: 13px; font-weight: 600;
            text-decoration: none; white-space: nowrap;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 2px 12px rgba(14,165,233,0.3), inset 0 1px 0 rgba(255,255,255,0.2);
            transition: all 0.25s;
        }
        .nav-cta:hover {
            transform: translateY(-1px) scale(1.03);
            box-shadow: 0 6px 20px rgba(14,165,233,0.5), inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .nav-cta:active { transform: scale(0.97); }

        .nav-lang {
            display: flex; align-items: center; gap: 6px;
        }
        .nav-lang a {
            font-size: 12px; font-weight: 700; font-family: 'Space Grotesk', sans-serif;
            text-decoration: none; color: var(--text-secondary);
            transition: color 0.2s;
        }
        .nav-lang a.active-lang { color: var(--neon-cyan); }
        .nav-lang span { color: rgba(255,255,255,0.15); font-size: 11px; }

        /* Hamburger */
        .nav-hamburger {
            display: none;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.8); font-size: 0;
            padding: 9px; cursor: pointer; border-radius: 11px;
            transition: background 0.2s, border-color 0.2s;
            flex-direction: column; gap: 5px; align-items: center; justify-content: center;
            width: 40px; height: 40px;
        }
        .nav-hamburger:hover { background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.18); }
        .nav-hamburger span {
            display: block; width: 20px; height: 2px;
            background: rgba(255,255,255,0.85); border-radius: 2px;
            transition: all 0.3s;
        }
        .nav-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .nav-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .nav-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* Dropdown */
        .nav-item-dropdown { position: relative; }
        .nav-dropdown {
            position: absolute; top: calc(100% + 10px); left: 50%; transform: translateX(-50%) translateY(8px);
            background: linear-gradient(160deg, rgba(8,18,42,0.97) 0%, rgba(14,26,56,0.97) 100%);
            backdrop-filter: blur(28px) saturate(200%);
            -webkit-backdrop-filter: blur(28px) saturate(200%);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 16px; padding: 8px; min-width: 210px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.06);
            opacity: 0; visibility: hidden; pointer-events: none;
            transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
            z-index: 10000;
        }
        .nav-item-dropdown:hover .nav-dropdown,
        .nav-item-dropdown:focus-within .nav-dropdown {
            opacity: 1; visibility: visible; pointer-events: auto;
            transform: translateX(-50%) translateY(0);
        }
        .nav-dropdown a {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 14px; color: rgba(255,255,255,0.68);
            text-decoration: none; font-size: 13px; font-weight: 500;
            border-radius: 10px; transition: all 0.2s;
        }
        .nav-dropdown a::before {
            content: '';
            display: block; width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--neon-cyan);
            opacity: 0; flex-shrink: 0;
            transition: opacity 0.2s;
        }
        .nav-dropdown a:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .nav-dropdown a:hover::before { opacity: 1; }

        /* HERO STRUCTURE */
        .hero {
            padding: 140px 24px 80px;
            position: relative;
            overflow: hidden;
        }
        .hero-inner {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 64px; align-items: center;
            width: 100%;
        }
        .hero-left { text-align: left; }
        .hero-right { position: relative; display: flex; justify-content: center; align-items: center; }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 7px 18px; border-radius: 100px;
            background: rgba(14,165,233,0.1);
            border: 1px solid rgba(14,165,233,0.25);
            color: var(--neon-cyan); font-size: 12px; font-weight: 700;
            letter-spacing: 1px; text-transform: uppercase;
            margin-bottom: 28px;
            animation: slideInUp 0.7s ease both;
        }
        .hero-badge .live-dot {
            width: 6px; height: 6px; background: var(--neon-cyan);
            border-radius: 50%; animation: livePulse 1.5s ease-in-out infinite;
            box-shadow: 0 0 8px var(--neon-cyan);
        }
        @keyframes livePulse { 0%,100%{opacity:1;box-shadow:0 0 8px var(--neon-cyan)} 50%{opacity:0.4;box-shadow:0 0 16px var(--neon-cyan)} }

        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(40px, 5.5vw, 76px);
            font-weight: 800;
            line-height: 1.08;
            margin-bottom: 24px;
            letter-spacing: -2px;
            animation: slideInUp 0.8s ease 0.1s both;
        }
        .hero-gradient-text {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--neon-cyan) 25%, var(--accent2) 50%, var(--accent3) 75%, var(--primary-light) 100%);
            background-size: 300% 300%;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: gradientFlow 6s ease infinite;
        }
        @keyframes gradientFlow {
            0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%}
        }

        .hero-sub {
            font-size: clamp(15px, 1.8vw, 18px);
            color: var(--text-secondary);
            max-width: 480px;
            line-height: 1.75;
            margin-bottom: 40px;
            animation: slideInUp 0.8s ease 0.2s both;
        }

        .hero-buttons {
            display: flex; gap: 14px; flex-wrap: wrap;
            animation: slideInUp 0.8s ease 0.3s both;
            margin-bottom: 48px;
        }
        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 15px 32px; border-radius: 16px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent2) 100%);
            color: #fff; font-size: 15px; font-weight: 700;
            text-decoration: none; border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 4px 30px rgba(14,165,233,0.35), inset 0 1px 0 rgba(255,255,255,0.2);
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .btn-hero-primary:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 8px 40px rgba(14,165,233,0.5); }
        .btn-hero-primary:active { transform: scale(0.97); }

        .btn-hero-glass {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 15px 32px; border-radius: 16px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(12px);
            color: var(--text-primary); font-size: 15px; font-weight: 600;
            text-decoration: none;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
            transition: all 0.3s;
        }
        .btn-hero-glass:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); transform: translateY(-2px); }

        /* LIVE SPEED COUNTER PANEL */
        .hero-speed-panel {
            display: flex; gap: 16px; align-items: center;
            animation: slideInUp 0.8s ease 0.4s both;
        }
        /* HERO HEADER (Banner + Small Brand) */
        .hero-header {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            margin-bottom: 40px; 
            max-width: 1100px; width: calc(100% - 32px);
            margin-left: auto; margin-right: auto;
            position: relative;
            margin-top: -140px;
            padding-top: 130px; /* Pushed further down from the navbar */
        }
        .hero-header-banner {
            width: 100%;
            margin-bottom: 20px;
        }
        .hero-header-brand-small {
            transform: scale(0.7);
            opacity: 0.8;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        @media (max-width: 900px) {
            .hero-header-brand-small { transform: scale(0.5); }
        }
        .speed-counter-box {
            display: flex; flex-direction: column; align-items: center;
            background: rgba(14,165,233,0.06);
            border: 1px solid rgba(14,165,233,0.2);
            border-radius: 20px; padding: 20px 28px;
            backdrop-filter: blur(12px);
            position: relative; overflow: hidden;
        }
        .speed-counter-box::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(14,165,233,0.5), transparent);
        }
        .speed-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 52px; font-weight: 900; line-height: 1;
            background: linear-gradient(135deg, #fff 0%, var(--neon-cyan) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .speed-unit-text { font-size: 11px; color: var(--text-secondary); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }
        .speed-label { font-size: 11px; color: var(--neon-cyan); font-weight: 600; margin-top: 6px; }

        .speed-mini-stats { display: flex; flex-direction: column; gap: 10px; }
        .mini-stat {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px; padding: 12px 18px;
            display: flex; align-items: center; gap: 10px;
        }
        .mini-stat-icon { font-size: 20px; }
        .mini-stat-val { font-family: 'Space Grotesk', sans-serif; font-size: 18px; font-weight: 800; color: #fff; }
        .mini-stat-lbl { font-size: 11px; color: var(--text-tertiary); font-weight: 500; }

        /* HERO RIGHT — NETWORK VISUAL */
        .hero-visual-wrap {
            position: relative; width: 100%; max-width: 520px;
            animation: slideInUp 0.9s ease 0.2s both;
        }
        .hero-network-img {
            width: 100%; border-radius: 28px;
            filter: drop-shadow(0 0 60px rgba(14,165,233,0.3));
            animation: heroImgFloat 6s ease-in-out infinite;
        }
        @keyframes heroImgFloat {
            0%,100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-18px) scale(1.02); }
        }

        /* FLOATING DATA PACKET NODES */
        .data-packets { position: absolute; inset: 0; pointer-events: none; }
        .packet {
            position: absolute; width: 10px; height: 10px;
            border-radius: 50%; opacity: 0;
        }
        .packet-1 { background: var(--neon-cyan); box-shadow: 0 0 12px var(--neon-cyan); top: 20%; left: 5%; animation: packetFloat1 4s ease-in-out 0.5s infinite; }
        .packet-2 { background: var(--accent2); box-shadow: 0 0 12px var(--accent2); top: 60%; right: 8%; animation: packetFloat2 5s ease-in-out 1s infinite; }
        .packet-3 { background: var(--accent3); box-shadow: 0 0 12px var(--accent3); bottom: 25%; left: 15%; animation: packetFloat3 3.5s ease-in-out 0.2s infinite; }
        .packet-4 { background: #10b981; box-shadow: 0 0 12px #10b981; top: 35%; right: 20%; animation: packetFloat1 4.5s ease-in-out 1.5s infinite; width: 7px; height: 7px; }
        .packet-5 { background: var(--primary-light); box-shadow: 0 0 10px var(--primary-light); top: 75%; left: 40%; animation: packetFloat2 3.8s ease-in-out 0.8s infinite; width: 8px; height: 8px; }
        @keyframes packetFloat1 {
            0%   { opacity:0; transform: translate(0,0) scale(0.5); }
            20%  { opacity:1; transform: translate(30px,-40px) scale(1); }
            80%  { opacity:1; transform: translate(80px,-100px) scale(0.8); }
            100% { opacity:0; transform: translate(120px,-150px) scale(0.2); }
        }
        @keyframes packetFloat2 {
            0%   { opacity:0; transform: translate(0,0) scale(0.5); }
            20%  { opacity:1; transform: translate(-25px,-35px) scale(1); }
            80%  { opacity:1; transform: translate(-70px,-90px) scale(0.8); }
            100% { opacity:0; transform: translate(-100px,-140px) scale(0.2); }
        }
        @keyframes packetFloat3 {
            0%   { opacity:0; transform: translate(0,0) scale(0.5); }
            25%  { opacity:1; transform: translate(20px,-50px) scale(1); }
            75%  { opacity:1; transform: translate(60px,-110px) scale(0.7); }
            100% { opacity:0; transform: translate(90px,-160px) scale(0.2); }
        }

        /* FLOATING INFO BADGES on visual */
        .hero-float-badge {
            position: absolute; display: flex; align-items: center; gap: 10px;
            background: rgba(10,20,40,0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px; padding: 12px 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }
        .hfb-1 { top: 10%; left: -30px; animation: badgeFloat1 5s ease-in-out infinite; }
        .hfb-2 { bottom: 15%; right: -20px; animation: badgeFloat2 6s ease-in-out infinite; }
        @keyframes badgeFloat1 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
        @keyframes badgeFloat2 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(10px)} }
        .hfb-icon { font-size: 24px; }
        .hfb-val { font-family: 'Space Grotesk', sans-serif; font-size: 18px; font-weight: 800; color: #fff; }
        .hfb-lbl { font-size: 11px; color: var(--text-tertiary); }

        /* SPEED MARQUEE */
        .speed-marquee {
            padding: 20px 0;
            background: rgba(14,165,233,0.04);
            border-top: 1px solid rgba(14,165,233,0.1);
            border-bottom: 1px solid rgba(14,165,233,0.1);
            overflow: hidden; position: relative; z-index: 2;
        }
        .marquee-track {
            display: flex; gap: 0;
            animation: marqueeScroll 30s linear infinite;
            width: max-content;
        }
        .marquee-track:hover { animation-play-state: paused; }
        @keyframes marqueeScroll { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
        .marquee-item {
            display: flex; align-items: center; gap: 12px;
            padding: 0 40px; white-space: nowrap;
            border-right: 1px solid rgba(255,255,255,0.06);
        }
        .marquee-item-icon { font-size: 20px; }
        .marquee-item-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px; font-weight: 800;
            background: linear-gradient(135deg, var(--primary-light), var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .marquee-item-lbl { font-size: 13px; color: var(--text-secondary); }
        .marquee-sep {
            display: flex; align-items: center;
            padding: 0 20px; color: rgba(14,165,233,0.3); font-size: 20px;
        }

        /* Speed Counter */
        .speed-ring {
            width: 160px; height: 160px; margin: 0 auto 16px;
            border-radius: 50%;
            background: conic-gradient(var(--primary) 0deg, var(--accent) 120deg, var(--accent2) 240deg, var(--primary) 360deg);
            padding: 4px; position: relative;
            animation: speedRingSpin 8s linear infinite;
        }
        @keyframes speedRingSpin { 0%{transform:rotate(0)} 100%{transform:rotate(360deg)} }
        .speed-ring-inner {
            width: 100%; height: 100%; border-radius: 50%;
            background: var(--bg-deep);
            display: flex; align-items: center; justify-content: center;
            flex-direction: column;
        }
        .speed-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 42px; font-weight: 800; line-height: 1;
            background: linear-gradient(135deg, var(--primary-light), var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .speed-unit { font-size: 12px; color: var(--text-secondary); font-weight: 600; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }

        /* HERO LOGO + BRAND ANIMATION */
        .hero-logo-wrap {
            position: relative; display: inline-block;
            margin-bottom: 28px;
            animation: heroLogoFloat 5s ease-in-out infinite;
        }
        @keyframes heroLogoFloat {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }
        .hero-logo-wrap img {
            width: 140px; height: 140px;
            object-fit: contain;
            mix-blend-mode: lighten;
            filter: drop-shadow(0 0 30px rgba(0,229,255,0.9)) drop-shadow(0 0 70px rgba(0,102,255,0.6));
        }

        /* Hero brand animated text */
        .hero-brand-anim {
            margin-bottom: 24px;
            overflow: hidden;
            height: 52px;
            display: flex; align-items: center;
        }
        .hba-inner {
            display: flex; align-items: center; gap: 10px;
            animation: heroBrandLoop 4s cubic-bezier(.77,0,.18,1) infinite;
        }
        @keyframes heroBrandLoop {
            0%   { opacity:0; transform:translateY(40px); }
            15%  { opacity:1; transform:translateY(0px);  }
            75%  { opacity:1; transform:translateY(0px);  }
            90%  { opacity:0; transform:translateY(-40px);}
            100% { opacity:0; transform:translateY(-40px);}
        }
        .hba-lines { display:flex;flex-direction:column;gap:4px;justify-content:center; }
        .hba-lines span {
            display:block;height:2.5px;border-radius:2px;
            background:linear-gradient(90deg,transparent,var(--neon-cyan));
            animation:hbaLinesSlide 4s cubic-bezier(.77,0,.18,1) infinite;
        }
        .hba-lines span:nth-child(1){width:22px;animation-delay:0.05s;}
        .hba-lines span:nth-child(2){width:16px;animation-delay:0.08s;}
        .hba-lines span:nth-child(3){width:10px;animation-delay:0.11s;}
        @keyframes hbaLinesSlide {
            0%  {transform:translateX(-20px);opacity:0;}
            18% {transform:translateX(0);opacity:1;}
            75% {transform:translateX(0);opacity:1;}
            90% {transform:translateX(20px);opacity:0;}
            100%{transform:translateX(-20px);opacity:0;}
        }
        .hba-stack { display:flex;flex-direction:column;line-height:1.1; }
        .hba-super,.hba-speed {
            font-family:'Space Grotesk',sans-serif;
            font-style:italic;font-weight:800;
            font-size:0.78rem;letter-spacing:.1em;
            color:rgba(255,255,255,0.85);
        }
        .hba-net {
            font-family:'Space Grotesk',sans-serif;
            font-size:2.2rem;font-weight:900;
            letter-spacing:-.01em;line-height:1;
            background:linear-gradient(90deg,#fff 0%,var(--neon-cyan) 60%,#fff 100%);
            background-size:200%;
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;
            animation:hbaNetShimmer 4s linear infinite;
        }
        @keyframes hbaNetShimmer {
            0%  {background-position:100% center;}
            100%{background-position:-100% center;}
        }

        /* ═══════════════════════════════════════════
           BANNER FADER (HERO HEADER)
           ═══════════════════════════════════════════ */
        .banner-slider {
            width: 100%;
            position: relative;
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 1fr;
        }
        .banner-track {
            display: contents; /* Let slides act as direct grid children */
        }
        .banner-slide {
            grid-column: 1;
            grid-row: 1;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
            transform: scale(0.98);
            pointer-events: none;
            z-index: 1;
        }
        .banner-slide.active {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
            z-index: 2;
        }
        .banner-slide a {
            display: block;
            width: 100%;
            max-width: 1000px;
            position: relative;
            border-radius: 28px;
            padding: 10px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 
                0 24px 50px -12px rgba(0,0,0,0.5),
                0 0 60px rgba(14,165,233,0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .banner-slide a:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 
                0 30px 60px -12px rgba(0,0,0,0.6),
                0 0 80px rgba(14,165,233,0.25);
            border-color: rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.05);
        }
        .banner-slide img {
            width: 100%;
            aspect-ratio: 21 / 8;
            object-fit: cover;
            display: block;
            border-radius: 20px;
        }
        .banner-dots {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 24px;
            z-index: 10;
            position: relative;
        }
        .banner-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .banner-dot:hover {
            background: rgba(255,255,255,0.5);
        }
        .banner-dot.active {
            background: var(--neon-cyan);
            box-shadow: 0 0 10px var(--neon-cyan);
            transform: scale(1.3);
        }

        /* ═══════════════════════════════════════════
           STATS TICKER
           ═══════════════════════════════════════════ */
        .stats-ticker {
            padding: 56px 0;
            background: rgba(255,255,255,0.015);
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px; text-align: center; }
        .stat-block {}
        .stat-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 44px; font-weight: 800; line-height: 1;
            background: linear-gradient(135deg, var(--primary-light), var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .stat-lbl { font-size: 13px; color: var(--text-tertiary); margin-top: 8px; font-weight: 500; letter-spacing: 0.5px; }

        /* ═══════════════════════════════════════════
           SECTION GENERIC
           ═══════════════════════════════════════════ */
        .section { padding: 120px 0; position: relative; z-index: 2; }
        .section-head { text-align: center; margin-bottom: 72px; }
        .section-chip {
            display: inline-block;
            padding: 5px 16px; border-radius: 100px;
            background: rgba(14,165,233,0.08);
            border: 1px solid rgba(14,165,233,0.2);
            color: var(--neon-cyan); font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 2px;
            margin-bottom: 20px;
        }
        .section-head h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(32px, 5vw, 52px);
            font-weight: 800; line-height: 1.15;
            letter-spacing: -1px;
        }
        .section-head p { font-size: 17px; color: var(--text-secondary); max-width: 520px; margin: 14px auto 0; line-height: 1.7; }

        /* ═══════════════════════════════════════════
           PACKAGES SECTION
           ═══════════════════════════════════════════ */
        .pkg-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }

        .pkg-card {
            position: relative; overflow: hidden;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 24px;
            padding: 36px 28px 28px;
            transition: all 0.45s cubic-bezier(0.4,0,0.2,1);
        }
        .pkg-card::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at 30% 0%, rgba(14,165,233,0.08), transparent 60%);
            opacity: 0; transition: opacity 0.45s;
            border-radius: 24px;
        }
        .pkg-card::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            opacity: 0; transition: opacity 0.45s;
        }
        .pkg-card:hover {
            transform: translateY(-8px);
            border-color: rgba(14,165,233,0.3);
            box-shadow: 0 24px 60px rgba(14,165,233,0.1), 0 0 80px rgba(14,165,233,0.04);
        }
        .pkg-card:hover::before, .pkg-card:hover::after { opacity: 1; }

        .pkg-card.featured {
            background: linear-gradient(135deg, rgba(14,165,233,0.08) 0%, rgba(99,102,241,0.06) 100%);
            border-color: rgba(14,165,233,0.3);
            box-shadow: 0 0 40px rgba(14,165,233,0.06);
        }
        .pkg-featured-tag {
            position: absolute; top: 18px; right: 18px;
            padding: 4px 12px; border-radius: 100px;
            background: linear-gradient(135deg, var(--primary), var(--accent2));
            font-size: 10px; font-weight: 800; color: #fff;
            letter-spacing: 0.5px; text-transform: uppercase;
            box-shadow: 0 2px 10px rgba(14,165,233,0.4);
        }
        .pkg-speed-tag { font-size: 11px; color: var(--neon-cyan); font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; }
        .pkg-title { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 700; margin-bottom: 8px; }
        .pkg-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 24px; min-height: 40px; }

        .pkg-price-row { display: flex; align-items: baseline; gap: 3px; margin-bottom: 6px; }
        .pkg-currency { font-size: 20px; font-weight: 700; color: var(--primary-light); }
        .pkg-amount {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 46px; font-weight: 800; line-height: 1;
            background: linear-gradient(135deg, var(--primary-light), var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .pkg-period { font-size: 14px; color: var(--text-tertiary); }

        .pkg-btrc-ref {
            font-size: 10px; color: var(--text-tertiary);
            padding: 5px 10px; border-radius: 6px;
            background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border);
            margin-bottom: 24px; display: inline-block;
        }
        .pkg-btrc-ref span { color: var(--neon-cyan); font-weight: 600; }

        .pkg-features { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 28px; }
        .pkg-features li { display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--text-secondary); }
        .pkg-check {
            width: 18px; height: 18px; border-radius: 50%; flex-shrink: 0;
}
        .pkg-check::after { content: '✓'; font-size: 9px; color: var(--success); font-weight: 800; }

        .btn-quick-pay {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent2) 100%);
            color: #fff; padding: 6px 16px; border-radius: 12px;
            font-size: 13px; font-weight: 600; text-decoration: none;
            box-shadow: 0 4px 15px rgba(14,165,233,0.3);
            transition: all 0.3s; margin-left: 8px;
        }
        .btn-quick-pay:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(14,165,233,0.4); }

        .btn-pkg {
            width: 100%; padding: 13px; border-radius: 14px; border: none; cursor: pointer;
            font-size: 14px; font-weight: 700; text-decoration: none; display: block; text-align: center;
            background: rgba(14,165,233,0.08);
            color: var(--primary-light);
            border: 1px solid rgba(14,165,233,0.2);
            transition: all 0.3s;
        }
        .btn-pkg:hover { background: linear-gradient(135deg, var(--primary), var(--accent2)); color: #fff; border-color: transparent; transform: translateY(-2px); box-shadow: 0 6px 24px rgba(14,165,233,0.3); }
        .btn-pkg.featured-btn { background: linear-gradient(135deg, var(--primary), var(--accent2)); color: #fff; border-color: transparent; box-shadow: 0 4px 20px rgba(14,165,233,0.3); }

        /* ═══════════════════════════════════════════
           FEATURES SECTION
           ═══════════════════════════════════════════ */
        .features-bg { background: rgba(255,255,255,0.01); }
        .feat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .feat-card {
            padding: 40px 28px; border-radius: 24px;
            background: var(--bg-surface); border: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
            position: relative; overflow: hidden;
        }
        .feat-card::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }
        .feat-card:hover {
            transform: translateY(-6px);
            border-color: rgba(14,165,233,0.2);
            background: rgba(255,255,255,0.05);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        .feat-icon {
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, rgba(14,165,233,0.12), rgba(99,102,241,0.08));
            border: 1px solid rgba(14,165,233,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; margin-bottom: 24px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feat-card:hover .feat-icon { transform: scale(1.1) rotate(-5deg); box-shadow: 0 4px 20px rgba(14,165,233,0.15); }
        .feat-card h3 { font-family: 'Space Grotesk', sans-serif; font-size: 19px; font-weight: 700; margin-bottom: 10px; }
        .feat-card p { font-size: 14px; color: var(--text-secondary); line-height: 1.75; }

        /* ═══════════════════════════════════════════
           BTRC COMPLIANCE
           ═══════════════════════════════════════════ */
        .btrc-bar {
            padding: 80px 0;
            background: linear-gradient(135deg, rgba(14,165,233,0.04), rgba(99,102,241,0.03));
            border-top: 1px solid var(--glass-border); border-bottom: 1px solid var(--glass-border);
        }
        .btrc-box {
            display: flex; align-items: center; gap: 48px;
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            border-radius: 28px; padding: 48px;
            backdrop-filter: blur(12px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
        }
        .btrc-icon { font-size: 72px; flex-shrink: 0; filter: drop-shadow(0 0 20px rgba(14,165,233,0.3)); }
        .btrc-box h2 { font-family: 'Space Grotesk', sans-serif; font-size: 28px; font-weight: 800; margin-bottom: 12px; }
        .btrc-box p { color: var(--text-secondary); font-size: 15px; line-height: 1.7; margin-bottom: 20px; }
        .btrc-link { color: var(--neon-cyan); font-weight: 600; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; transition: gap 0.2s; }
        .btrc-link:hover { gap: 10px; }

        /* ═══════════════════════════════════════════
           CTA
           ═══════════════════════════════════════════ */
        .cta { text-align: center; }
        .cta-card {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(99,102,241,0.06));
            border: 1px solid rgba(14,165,233,0.2);
            border-radius: 32px; padding: 80px 48px;
        }
        .cta-card::before {
            content: ''; position: absolute; width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(14,165,233,0.12), transparent);
            top: -200px; right: -150px; border-radius: 50%;
            animation: ctaOrb 10s ease-in-out infinite alternate;
        }
        @keyframes ctaOrb { 0%{transform:scale(1) translate(0,0)} 100%{transform:scale(1.1) translate(-20px,20px)} }
        .cta-card h2 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(28px, 4vw, 44px); font-weight: 900; margin-bottom: 16px; letter-spacing: -1px; position: relative; }
        .cta-card p { color: var(--text-secondary); font-size: 17px; max-width: 480px; margin: 0 auto 40px; position: relative; }
        .cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; position: relative; }

        /* ═══════════════════════════════════════════
           FOOTER
           ═══════════════════════════════════════════ */
        footer { padding: 80px 0 32px; border-top: 1px solid var(--glass-border); background: rgba(0,0,0,0.25); }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
        .footer-brand-text { font-size: 14px; color: var(--text-secondary); line-height: 1.8; max-width: 260px; margin-top: 16px; }
        .footer-brand-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .footer-brand-logo img { width: 40px; height: 40px; border-radius: 10px; }
        .footer-brand-logo span { font-family: 'Space Grotesk', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-primary); }
        .footer-col h4 { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-tertiary); margin-bottom: 18px; }
        .footer-col a { display: block; color: var(--text-secondary); text-decoration: none; font-size: 14px; padding: 4px 0; transition: color 0.2s, transform 0.2s; }
        .footer-col a:hover { color: var(--neon-cyan); transform: translateX(3px); }
        .footer-bar { padding-top: 32px; border-top: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; }
        .footer-bar p { font-size: 12px; color: var(--text-tertiary); }
        .btrc-stamp {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 8px;
            background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.15);
            color: var(--success); font-size: 11px; font-weight: 700;
        }
        .footer-address { font-size: 13px; color: var(--text-secondary); margin-top: 10px; line-height: 1.6; }
        .footer-contact-info { margin-top: 10px; }
        .footer-contact-info a { display: block; color: var(--text-secondary); text-decoration: none; font-size: 13px; padding: 2px 0; transition: color 0.2s; }
        .footer-contact-info a:hover { color: var(--neon-cyan); }
        /* Social Media */
        .footer-social { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }
        .social-btn {
            display: flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            color: var(--text-secondary); transition: all 0.25s; text-decoration: none;
        }
        .social-btn svg { width: 16px; height: 16px; }
        .social-btn:hover { background: rgba(14,165,233,0.15); border-color: rgba(14,165,233,0.3); color: var(--neon-cyan); transform: translateY(-2px); }
        /* CTA Address */
        .cta-address { margin-top: 20px; font-size: 14px; color: rgba(255,255,255,0.6); }
        .footer-bar strong { color: var(--neon-cyan); }
        /* ═══════════════════════════════════════════
           ANIMATIONS
           ═══════════════════════════════════════════ */
        @keyframes slideInUp { from { opacity:0; transform:translateY(30px) } to { opacity:1; transform:translateY(0) } }

        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }
        .reveal-delay-5 { transition-delay: 0.5s; }

        /* ═══════════════════════════════════════════
           MOBILE SIDEBAR OVERLAY
           ═══════════════════════════════════════════ */
        .mobile-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 8998;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .mobile-overlay.open { display: block; opacity: 1; }

        .mobile-sidebar {
            position: fixed; top: 0; right: -320px;
            width: 300px; height: 100dvh;
            background: linear-gradient(160deg, rgba(6,14,32,0.98) 0%, rgba(10,22,50,0.98) 100%);
            border-left: 1px solid rgba(255,255,255,0.09);
            backdrop-filter: blur(30px);
            z-index: 8999;
            display: flex; flex-direction: column;
            padding: 0;
            transition: right 0.35s cubic-bezier(0.4,0,0.2,1);
            box-shadow: -20px 0 60px rgba(0,0,0,0.5);
        }
        .mobile-sidebar.open { right: 0; }

        .sidebar-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .sidebar-brand img {
            width: 36px; height: 36px; border-radius: 10px; object-fit: cover;
            filter: drop-shadow(0 0 6px rgba(34,211,238,0.6));
        }
        .sidebar-brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px; font-weight: 800;
            background: linear-gradient(90deg, #fff, var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .sidebar-close {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7); font-size: 18px;
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s;
        }
        .sidebar-close:hover { background: rgba(255,255,255,0.12); color: #fff; }

        .sidebar-nav {
            flex: 1; overflow-y: auto;
            padding: 16px 12px;
            display: flex; flex-direction: column; gap: 4px;
        }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 14px; border-radius: 12px;
            color: rgba(255,255,255,0.72); text-decoration: none;
            font-size: 14px; font-weight: 500;
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .sidebar-link:hover {
            background: rgba(14,165,233,0.1);
            border-color: rgba(14,165,233,0.2);
            color: #fff;
        }
        .sidebar-link-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,0.06);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }

        .sidebar-section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 0.15em;
            text-transform: uppercase; color: var(--text-tertiary);
            padding: 12px 14px 4px;
        }

        .sidebar-dropdown-toggle {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 14px; border-radius: 12px;
            color: rgba(255,255,255,0.72);
            font-size: 14px; font-weight: 500;
            cursor: pointer; transition: all 0.2s;
            border: 1px solid transparent;
            user-select: none;
        }
        .sidebar-dropdown-toggle:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }
        .sidebar-dropdown-toggle .toggle-arrow {
            margin-left: auto;
            font-size: 11px;
            transition: transform 0.3s;
            color: var(--text-tertiary);
        }
        .sidebar-dropdown-toggle.open .toggle-arrow { transform: rotate(180deg); }

        .sidebar-dropdown-items {
            display: none;
            flex-direction: column;
            gap: 2px;
            padding: 4px 0 4px 42px;
        }
        .sidebar-dropdown-items.open { display: flex; }
        .sidebar-dropdown-items a {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 12px; border-radius: 10px;
            color: rgba(255,255,255,0.6); text-decoration: none;
            font-size: 13px; transition: all 0.2s;
        }
        .sidebar-dropdown-items a::before {
            content: '';
            width: 4px; height: 4px;
            border-radius: 50%;
            background: var(--neon-cyan);
            flex-shrink: 0;
        }
        .sidebar-dropdown-items a:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }

        .sidebar-footer {
            padding: 16px 12px 24px;
            border-top: 1px solid rgba(255,255,255,0.07);
            display: flex; flex-direction: column; gap: 10px;
        }
        .sidebar-cta {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 13px 20px; border-radius: 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent2) 100%);
            color: #fff; font-size: 14px; font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(14,165,233,0.35);
            transition: all 0.25s;
        }
        .sidebar-cta:hover { transform: translateY(-1px); box-shadow: 0 6px 24px rgba(14,165,233,0.5); }

        .sidebar-lang-row {
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .sidebar-lang-row a {
            font-size: 13px; font-weight: 700;
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text-secondary); text-decoration: none; transition: color 0.2s;
        }
        .sidebar-lang-row a.active-lang { color: var(--neon-cyan); }

        /* ═══════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════ */
        @media (max-width: 1000px) {
            .nav-links-group { display: none !important; }
            .nav-lang { display: none; }
            .nav-hamburger { display: flex !important; }
            .glass-nav { grid-template-columns: auto auto; }
            .nav-actions .nav-cta { display: none; }
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .feat-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .btrc-box { flex-direction: column; text-align: center; gap: 28px; }
        }
        @media (min-width: 1001px) {
            .mobile-sidebar, .mobile-overlay { display: none !important; }
        }
        @media (max-width: 600px) {
            .glass-nav { top: 8px; width: calc(100% - 16px); border-radius: 16px; padding: 8px 12px; }
            .pkg-grid { grid-template-columns: 1fr; }
            .feat-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .hero-buttons { flex-direction: column; align-items: center; }
            .cta-btns { flex-direction: column; align-items: center; }
            .cta-card { padding: 48px 24px; }
            .stats-row { grid-template-columns: 1fr 1fr; gap: 12px; }
        }
        /* ════ PAYMENT INSTRUCTION BOX ════ */
        .pay-bill-glass-box {
            position: relative;
            background: linear-gradient(145deg, rgba(14, 165, 233, 0.05) 0%, rgba(14, 165, 233, 0.15) 100%);
            border: 1px solid rgba(34, 211, 238, 0.2);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 50px;
            display: flex;
            align-items: center;
            gap: 30px;
            box-shadow: 0 10px 40px -10px rgba(14, 165, 233, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .pay-bill-glass-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px -10px rgba(14, 165, 233, 0.2);
            border-color: rgba(34, 211, 238, 0.4);
        }
        .pay-bill-icon-wrapper {
            position: relative;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--neon-cyan));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            flex-shrink: 0;
            z-index: 2;
        }
        .pay-bill-pulse {
            position: absolute;
            inset: -10px;
            border-radius: 50%;
            background: var(--neon-cyan);
            opacity: 0.3;
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
            z-index: -1;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.5; }
            100% { transform: scale(1.5); opacity: 0; }
        }
        .pay-bill-content h3 {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(90deg, #fff, var(--neon-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .pay-bill-content p {
            color: var(--text-secondary);
            font-size: 16px;
            line-height: 1.7;
            margin: 0;
        }
        .highlight-number {
            display: inline-block;
            background: rgba(34, 211, 238, 0.15);
            color: var(--neon-cyan);
            padding: 4px 12px;
            border-radius: 8px;
            font-family: monospace;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1px;
            border: 1px dashed rgba(34, 211, 238, 0.4);
            margin: 0 4px;
        }
        @media (max-width: 600px) {
            .pay-bill-glass-box {
                flex-direction: column;
                text-align: center;
                padding: 30px 20px;
                gap: 20px;
            }
        }
    </style>
</head>
<body>

<!-- ═══ BACKGROUND SCENE ═══ -->
<div class="bg-scene">
    <div class="mesh-gradient"></div>
    <div class="grid-overlay"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <canvas id="particleCanvas"></canvas>
</div>

<!-- ═══ PREMIUM NAVBAR ═══ -->
<nav class="glass-nav" id="glassNav">
    <!-- Left: Logo + Brand -->
    <a href="#" class="nav-logo-link">
        <img src="/images/logo.png" alt="SuperSpeed" class="nav-logo-img">
        <span class="nav-brand">
            <span class="nb-lines">
                <span></span><span></span><span></span>
            </span>
            <span style="display:flex;flex-direction:column;line-height:1.05">
                <span class="nb-stack">
                    <span class="nb-super">SUPER</span>
                    <span class="nb-speed">SPEED</span>
                </span>
            </span>
            <span class="nb-network">NET</span>
        </span>
    </a>

    <!-- Center: Nav Links -->
    <div class="nav-links-group" id="navLinksGroup">
        @if(isset($menus))
            @foreach($menus as $menu)
                @if(isset($menu['children']) && count($menu['children']) > 0)
                    <div class="nav-item-dropdown" tabindex="0">
                        <a href="{{ $menu['url'] }}" class="nav-link">{{ __($menu['name']) }} ▾</a>
                        <div class="nav-dropdown">
                            @foreach($menu['children'] as $child)
                                <a href="{{ $child['url'] }}">{{ __($child['name']) }}</a>
                            @endforeach
                        </div>
                    </div>
                @elseif(str_contains(strtolower($menu['name']), 'pay'))
                    {{-- Pay links shown in actions on desktop --}}
                @else
                    <a href="{{ $menu['url'] }}" class="nav-link">{{ __($menu['name']) }}</a>
                @endif
            @endforeach
        @endif
        <div class="nav-pill" id="navPill"></div>
    </div>

    <!-- Right: Actions -->
    <div class="nav-actions">
        <div class="nav-lang">
            <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active-lang' : '' }}">EN</a>
            <span>|</span>
            <a href="{{ route('lang.switch', 'bn') }}" class="{{ app()->getLocale() === 'bn' ? 'active-lang' : '' }}">BN</a>
        </div>
        <a href="{{ route('login') }}" class="nav-cta">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            {{ __('Login') }}
        </a>
        <button class="nav-hamburger" id="navHamburger" aria-label="Open Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- ═══ MOBILE SIDEBAR ═══ -->
<div class="mobile-overlay" id="mobileOverlay"></div>
<aside class="mobile-sidebar" id="mobileSidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <img src="/images/logo.png" alt="SuperSpeed">
            <span class="sidebar-brand-name">SuperSpeed NET</span>
        </a>
        <button class="sidebar-close" id="sidebarClose">✕</button>
    </div>

    <nav class="sidebar-nav">
        @if(isset($menus))
            @foreach($menus as $menu)
                @if(isset($menu['children']) && count($menu['children']) > 0)
                    <div class="sidebar-dropdown-toggle" onclick="this.classList.toggle('open'); this.nextElementSibling.classList.toggle('open')">
                        <span class="sidebar-link-icon">📁</span>
                        {{ __($menu['name']) }}
                        <span class="toggle-arrow">▾</span>
                    </div>
                    <div class="sidebar-dropdown-items">
                        @foreach($menu['children'] as $child)
                            <a href="{{ $child['url'] }}">{{ __($child['name']) }}</a>
                        @endforeach
                    </div>
                @else
                    @php
                        $icons = ['Home'=>'🏠','Packages'=>'📦','Support'=>'🎧','Contact'=>'📞','About Us'=>'ℹ️','BTRC Tariff'=>'📄','New Connection'=>'🔗'];
                        $icon = $icons[$menu['name']] ?? '🔹';
                    @endphp
                    <a href="{{ $menu['url'] }}" class="sidebar-link">
                        <span class="sidebar-link-icon">{{ $icon }}</span>
                        {{ __($menu['name']) }}
                    </a>
                @endif
            @endforeach
        @endif
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('login') }}" class="sidebar-cta">
            🔐 {{ __('Login to Dashboard') }}
        </a>
        <div class="sidebar-lang-row">
            <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active-lang' : '' }}">EN</a>
            <span style="color:rgba(255,255,255,0.2)">|</span>
            <a href="{{ route('lang.switch', 'bn') }}" class="{{ app()->getLocale() === 'bn' ? 'active-lang' : '' }}">বাংলা</a>
        </div>
    </div>
</aside>


<!-- ═══ HERO ═══ -->
<section class="hero" id="hero">
    <div class="hero-header">
        <div class="hero-header-banner">
            @if(isset($banners) && $banners->count() > 0)
            <div class="banner-slider" id="banners">
                <div class="banner-track">
                    @foreach($banners as $index => $banner)
                    <div class="banner-slide {{ $index === 0 ? 'active' : '' }}">
                        <a href="{{ $banner->link_url ?? '#' }}">
                            <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}">
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="banner-dots">
                    @foreach($banners as $index => $banner)
                    <div class="banner-dot {{ $index === 0 ? 'active' : '' }}"></div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="hero-header-brand-small">
            <div class="hero-logo-wrap" style="margin-bottom: 0;">
                <img src="/images/logo.png" alt="SuperSpeed Net">
            </div>
            <div class="hero-brand-anim">
                <div class="hba-inner">
                    <span class="hba-lines">
                        <span></span><span></span><span></span>
                    </span>
                    <span class="hba-stack">
                        <span class="hba-super">SUPER</span>
                        <span class="hba-speed">SPEED</span>
                    </span>
                    <span class="hba-net">NET</span>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-inner">
        <!-- LEFT: Text + Counters -->
        <div class="hero-left">
            <div class="hero-badge">
                <span class="live-dot"></span>
                {{ __('BTRC Licensed ISP — LIVE NETWORK') }}
            </div>

            <h1>
                {{ __("Bangladesh's") }}
                <span class="hero-gradient-text">{{ __('Fastest Fiber') }}</span>
                {{ __('Internet') }}
            </h1>
            <p class="hero-sub">{{ $hero_description ?? 'Blazing-fast dedicated bandwidth with zero throttling. Powering homes and businesses across Bangladesh with enterprise-grade fiber.' }}</p>
            <div class="hero-buttons">
                <a href="#packages" class="btn-hero-primary">🚀 {{ __('View Packages') }}</a>
                <a href="#contact" class="btn-hero-glass">📞 {{ __('Free Consultation') }}</a>
            </div>

            <!-- Live Speed Counter Panel -->
            <div class="hero-speed-panel">
                <div class="speed-counter-box">
                    <div class="speed-val" id="liveSpeedCounter" data-target="{{ preg_replace('/[^0-9]/', '', $hero_network_speed ?? '1024') }}">0</div>
                    <div class="speed-unit-text">{{ __('Mbps') }}</div>
                    <div class="speed-label">⚡ {{ __('Network Speed') }}</div>
                </div>
                <div class="speed-mini-stats">
                    <div class="mini-stat">
                        <span class="mini-stat-icon">🟢</span>
                        <div>
                            <div class="mini-stat-val">{{ $hero_uptime ?? '99.9%' }}</div>
                            <div class="mini-stat-lbl">{{ __('Uptime SLA') }}</div>
                        </div>
                    </div>
                    <div class="mini-stat">
                        <span class="mini-stat-icon">⚡</span>
                        <div>
                            <div class="mini-stat-val" id="latencyCounter" data-target="{{ preg_replace('/[^0-9]/', '', $hero_latency ?? '2') }}">0ms</div>
                            <div class="mini-stat-lbl">{{ __('Avg. Latency') }}</div>
                        </div>
                    </div>
                    <div class="mini-stat">
                        <span class="mini-stat-icon">🌐</span>
                        <div>
                            <div class="mini-stat-val" id="clientCounter" data-target="{{ preg_replace('/[^0-9]/', '', $hero_active_clients ?? '1200') }}">0+</div>
                            <div class="mini-stat-lbl">{{ __('Active Clients') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Network Visual + Floating Badges -->
        <div class="hero-right">
            <div class="hero-visual-wrap">
                <!-- Floating Data Packets -->
                <div class="data-packets">
                    <div class="packet packet-1"></div>
                    <div class="packet packet-2"></div>
                    <div class="packet packet-3"></div>
                    <div class="packet packet-4"></div>
                    <div class="packet packet-5"></div>
                </div>

                <!-- Network Image -->
                <video src="/images/network-map.mp4" class="hero-network-img" autoplay loop muted playsinline style="object-fit: cover; border-radius: 20px;"></video>

                <!-- Floating Badges -->
                <div class="hero-float-badge hfb-1">
                    <span class="hfb-icon">🔥</span>
                    <div>
                        <div class="hfb-val">10 {{ __('Gbps') }}</div>
                        <div class="hfb-lbl">{{ __('Backbone Speed') }}</div>
                    </div>
                </div>
                <div class="hero-float-badge hfb-2">
                    <span class="hfb-icon">🛡️</span>
                    <div>
                        <div class="hfb-val">{{ __('BTRC') }}</div>
                        <div class="hfb-lbl">{{ __('Licensed & Compliant') }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ═══ SPEED MARQUEE ═══ -->
<div class="speed-marquee">
    <div class="marquee-track" id="marqueeTrack">
        <div class="marquee-item"><span class="marquee-item-icon">🛡️</span><span class="marquee-item-lbl">{{ $settings['marquee_1'] }}</span></div>
        <div class="marquee-sep">◆</div>
        <div class="marquee-item"><span class="marquee-item-icon">💎</span><span class="marquee-item-lbl">{{ $settings['marquee_2'] }}</span></div>
        <div class="marquee-sep">◆</div>
        <div class="marquee-item"><span class="marquee-item-icon">🕐</span><span class="marquee-item-lbl">{{ $settings['marquee_3'] }}</span></div>
        <div class="marquee-sep">◆</div>
        <div class="marquee-item"><span class="marquee-item-icon">📶</span><span class="marquee-item-lbl">{{ $settings['marquee_4'] }}</span></div>
        <div class="marquee-sep">◆</div>
        <!-- Duplicate for seamless loop -->
        <div class="marquee-item"><span class="marquee-item-icon">🛡️</span><span class="marquee-item-lbl">{{ $settings['marquee_1'] }}</span></div>
        <div class="marquee-sep">◆</div>
        <div class="marquee-item"><span class="marquee-item-icon">💎</span><span class="marquee-item-lbl">{{ $settings['marquee_2'] }}</span></div>
        <div class="marquee-sep">◆</div>
        <div class="marquee-item"><span class="marquee-item-icon">🕐</span><span class="marquee-item-lbl">{{ $settings['marquee_3'] }}</span></div>
        <div class="marquee-sep">◆</div>
        <div class="marquee-item"><span class="marquee-item-icon">📶</span><span class="marquee-item-lbl">{{ $settings['marquee_4'] }}</span></div>
        <div class="marquee-sep">◆</div>
    </div>
</div>

<!-- ═══ STATS ═══ -->
<section class="stats-ticker">
    <div class="container">
        <div class="stats-row">
            <div class="stat-block reveal"><div class="stat-val" id="s1" data-target="{{ $settings['stat_1_val'] }}">{{ $settings['stat_1_val'] }}</div><div class="stat-lbl">{{ $settings['stat_1_lbl'] }}</div></div>
            <div class="stat-block reveal reveal-delay-1"><div class="stat-val" id="s2" data-target="{{ $settings['stat_2_val'] }}">{{ $settings['stat_2_val'] }}</div><div class="stat-lbl">{{ $settings['stat_2_lbl'] }}</div></div>
            <div class="stat-block reveal reveal-delay-2"><div class="stat-val" id="s3" data-target="{{ $settings['stat_3_val'] }}">{{ $settings['stat_3_val'] }}</div><div class="stat-lbl">{{ $settings['stat_3_lbl'] }}</div></div>
            <div class="stat-block reveal reveal-delay-3"><div class="stat-val" id="s4" data-target="{{ $settings['stat_4_val'] }}">{{ $settings['stat_4_val'] }}</div><div class="stat-lbl">{{ $settings['stat_4_lbl'] }}</div></div>
        </div>
    </div>
</section>

<!-- ═══ PACKAGES ═══ -->
<section class="section" id="packages">
    <div class="container">
        <div class="section-head reveal">
            <div class="section-chip">{{ __('Internet Packages') }}</div>
            <h2>{{ $settings['packages_heading'] }}</h2>
            <p>{{ $settings['packages_sub'] }}</p>
        </div>
        <div class="pkg-grid" id="pkgGrid">
            @if(isset($packages) && count($packages) > 0)
                @php
                    $mid = floor(count($packages) / 2);
                @endphp
                @foreach($packages as $index => $p)
                    @php
                        $isFeat = $index === (int)$mid;
                        $feat = is_array($p['features']) ? $p['features'] : json_decode($p['features'] ?? '[]', true);
                    @endphp
                    <div class="pkg-card {{ $isFeat ? 'featured' : '' }} reveal reveal-delay-{{ $index }}">
                        @if($isFeat)<span class="pkg-featured-tag">⭐ Most Popular</span>@endif
                        <div class="pkg-speed-tag">{{ $p['speed_mbps'] >= 1000 ? ($p['speed_mbps']/1000) . ' Gbps' : $p['speed_mbps'] . ' Mbps' }} Dedicated</div>
                        <div class="pkg-title">{{ $p['name'] }}</div>
                        <div class="pkg-desc">{{ $p['description'] ?? '' }}</div>
                        <div class="pkg-price-row">
                            <span class="pkg-currency">৳</span>
                            <span class="pkg-amount">{{ number_format((float)$p['price']) }}</span>
                            <span class="pkg-period">/mo</span>
                        </div>
                        @if($p['btrc_approval_number'])
                        <div class="pkg-btrc-ref">BTRC: <span>{{ $p['btrc_approval_number'] }}</span></div>
                        @endif
                        <ul class="pkg-features">
                            @foreach($feat as $f)
                                <li><span class="pkg-check"></span>{{ $f }}</li>
                            @endforeach
                        </ul>
                        <a href="#contact" class="btn-pkg {{ $isFeat ? 'featured-btn' : '' }}">Get Started →</a>
                    </div>
                @endforeach
            @else
                <div style="grid-column:1/-1;text-align:center;padding:60px 0;color:var(--text-tertiary)">No packages available.</div>
            @endif
        </div>
    </div>
</section>

<!-- Removed external banner slider as it's now in hero-right -->

<!-- ═══ FEATURES ═══ -->
<section class="section features-bg" id="features">
    <div class="container">
        <div class="section-head reveal">
            <div class="section-chip">{{ $settings['features_chip'] }}</div>
            <h2>{{ $settings['features_heading'] }}</h2>
            <p>{{ $settings['features_sub'] }}</p>
        </div>
        <div class="feat-grid">
            <div class="feat-card reveal"><div class="feat-icon">⚡</div><h3>{{ $settings['feat_1_title'] }}</h3><p>{{ $settings['feat_1_desc'] }}</p></div>
            <div class="feat-card reveal reveal-delay-1"><div class="feat-icon">🌐</div><h3>{{ $settings['feat_2_title'] }}</h3><p>{{ $settings['feat_2_desc'] }}</p></div>
            <div class="feat-card reveal reveal-delay-2"><div class="feat-icon">🛡️</div><h3>{{ $settings['feat_3_title'] }}</h3><p>{{ $settings['feat_3_desc'] }}</p></div>
            <div class="feat-card reveal reveal-delay-3"><div class="feat-icon">🕐</div><h3>{{ $settings['feat_4_title'] }}</h3><p>{{ $settings['feat_4_desc'] }}</p></div>
            <div class="feat-card reveal reveal-delay-4"><div class="feat-icon">💳</div><h3>{{ $settings['feat_5_title'] }}</h3><p>{{ $settings['feat_5_desc'] }}</p></div>
            <div class="feat-card reveal reveal-delay-5"><div class="feat-icon">📊</div><h3>{{ $settings['feat_6_title'] }}</h3><p>{{ $settings['feat_6_desc'] }}</p></div>
        </div>
    </div>
</section>

<!-- ═══ BTRC ═══ -->
<section class="btrc-bar">
    <div class="container">
        <div class="btrc-box reveal">
            <div class="btrc-icon">🏛️</div>
            <div>
                <h2>{{ $settings['btrc_heading'] }}</h2>
                <p>{!! $settings['btrc_desc'] !!}</p>
                <a href="{{ $settings['btrc_link_url'] }}" target="_blank" class="btrc-link">{{ $settings['btrc_link_lbl'] }} →</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══ CTA ═══ -->
<section class="section cta" id="contact">
    <div class="container">
        @if(!empty($settings['pay_bill_instruction']))
        <div class="pay-bill-instruction reveal" style="background: rgba(14, 165, 233, 0.1); border: 1px solid rgba(14, 165, 233, 0.3); border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 40px;">
            <h3 style="color: var(--neon-cyan); margin-bottom: 10px; font-size: 1.2rem;">💳 {{ __('Payment Instruction') }}</h3>
            <p style="color: var(--text-secondary); margin: 0; line-height: 1.6;">{!! nl2br(e($settings['pay_bill_instruction'])) !!}</p>
        </div>
        @endif

        <div class="cta-card reveal">
            <h2>{{ $settings['cta_heading'] }}</h2>
            <p>{{ $settings['cta_sub'] }}</p>
            <div class="cta-btns">
                <a href="tel:{{ $settings['site_phone'] }}" class="btn-hero-primary">📞 {{ $settings['site_phone'] }}</a>
                <a href="mailto:{{ $settings['site_email'] }}" class="btn-hero-glass">✉️ {{ $settings['site_email'] }}</a>
            </div>
            @if($settings['site_address'])
            <div class="cta-address">📍 {{ $settings['site_address'] }}</div>
            @endif
        </div>
    </div>
</section>

<!-- ═══ FOOTER ═══ -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand-col">
                <a href="#" class="footer-brand-logo"><img src="/images/logo.png" alt="{{ $settings['site_name'] }}"><span>{{ $settings['site_name'] }}</span></a>
                <p class="footer-brand-text">{{ $settings['footer_brand_text'] }}</p>
                @if($settings['site_address'])
                <p class="footer-address">📍 {{ $settings['site_address'] }}</p>
                @endif
                <p class="footer-contact-info">
                    <a href="tel:{{ $settings['site_phone'] }}">📞 {{ $settings['site_phone'] }}</a><br>
                    <a href="mailto:{{ $settings['site_email'] }}">✉️ {{ $settings['site_email'] }}</a>
                </p>
                <!-- Social Media Icons -->
                <div class="footer-social">
                    @if($settings['social_facebook'])<a href="{{ $settings['social_facebook'] }}" target="_blank" class="social-btn" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>@endif
                    @if($settings['social_youtube'])<a href="{{ $settings['social_youtube'] }}" target="_blank" class="social-btn" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                    </a>@endif
                    @if($settings['social_instagram'])<a href="{{ $settings['social_instagram'] }}" target="_blank" class="social-btn" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>@endif
                    @if($settings['social_twitter'])<a href="{{ $settings['social_twitter'] }}" target="_blank" class="social-btn" aria-label="Twitter/X">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>@endif
                    @if($settings['social_whatsapp'])<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['social_whatsapp']) }}" target="_blank" class="social-btn" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                    </a>@endif
                </div>
            </div>
            <div class="footer-col"><h4>{{ __('Packages') }}</h4><a href="#packages">Starter 5 Mbps</a><a href="#packages">Home 10 Mbps</a><a href="#packages">Power 20 Mbps</a><a href="#packages">Business 50 Mbps</a><a href="#packages">Enterprise 100 Mbps</a></div>
            <div class="footer-col"><h4>{{ __('Company') }}</h4><a href="#">{{ __('About Us') }}</a><a href="#">{{ __('Coverage') }}</a><a href="#contact">{{ __('Contact') }}</a><a href="/support">{{ __('Support Ticket') }}</a></div>
            <div class="footer-col"><h4>{{ __('Legal') }}</h4><a href="{{ $settings['btrc_link_url'] }}" target="_blank">{{ __('BTRC Tariff Matrix') }}</a><a href="#">{{ __('Privacy Policy') }}</a><a href="#">{{ __('Terms of Service') }}</a><a href="#">{{ __('SLA Agreement') }}</a></div>
        </div>
        <div class="footer-bar">
            <p>{{ $settings['footer_copy'] }} &nbsp;|&nbsp; {{ __('Developed by') }} <strong>{{ $settings['developer_name'] }}</strong></p>
            <div class="btrc-stamp">✅ {{ __('BTRC Licensed ISP') }}</div>
        </div>
    </div>
</footer>

<!-- ═══ JAVASCRIPT ═══ -->
<script>
// ─── PARTICLES ───
(function(){
    const c = document.getElementById('particleCanvas');
    const ctx = c.getContext('2d');
    let w, h, particles = [];
    function resize(){ w = c.width = window.innerWidth; h = c.height = window.innerHeight; }
    window.addEventListener('resize', resize); resize();
    class Particle {
        constructor(){ this.reset(); }
        reset(){
            this.x = Math.random()*w; this.y = Math.random()*h;
            this.vx = (Math.random()-0.5)*0.3; this.vy = (Math.random()-0.5)*0.3;
            this.r = Math.random()*1.5+0.5;
            this.alpha = Math.random()*0.4+0.1;
        }
        update(){
            this.x += this.vx; this.y += this.vy;
            if(this.x<0||this.x>w||this.y<0||this.y>h) this.reset();
        }
        draw(){
            ctx.beginPath(); ctx.arc(this.x,this.y,this.r,0,Math.PI*2);
            ctx.fillStyle=`rgba(14,165,233,${this.alpha})`; ctx.fill();
        }
    }
    for(let i=0;i<60;i++) particles.push(new Particle());
    function drawLines(){
        for(let i=0;i<particles.length;i++){
            for(let j=i+1;j<particles.length;j++){
                const dx=particles[i].x-particles[j].x,dy=particles[i].y-particles[j].y;
                const d=Math.sqrt(dx*dx+dy*dy);
                if(d<150){
                    ctx.beginPath(); ctx.moveTo(particles[i].x,particles[i].y);
                    ctx.lineTo(particles[j].x,particles[j].y);
                    ctx.strokeStyle=`rgba(14,165,233,${0.06*(1-d/150)})`;
                    ctx.lineWidth=0.5; ctx.stroke();
                }
            }
        }
    }
    function animate(){
        ctx.clearRect(0,0,w,h);
        particles.forEach(p=>{p.update();p.draw()});
        drawLines();
        requestAnimationFrame(animate);
    }
    animate();
})();

// ─── SCROLL REVEAL ───
(function(){
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); obs.unobserve(e.target); }});
    }, {threshold: 0.1});
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
})();

// ─── COUNTER ANIMATION ───
function animateCount(el, target, suffix='', duration=1800){
    let start=0; const step=target/(duration/16);
    const timer = setInterval(()=>{
        start+=step;
        if(start>=target){ el.textContent=target.toLocaleString()+suffix; clearInterval(timer); return; }
        el.textContent=Math.floor(start).toLocaleString()+suffix;
    },16);
}

// Stats
const statsObs = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
        if(e.isIntersecting){
            ['s1','s2','s3','s4'].forEach(id => {
                const el = document.getElementById(id);
                if(el){
                    const val = el.getAttribute('data-target');
                    const numMatch = val.replace(/,/g, '').match(/[\d.]+/);
                    if(numMatch){
                        const num = parseFloat(numMatch[0]);
                        const suffix = val.replace(/[\d.,]/g, '').trim();
                        animateCount(el, num, suffix);
                    } else {
                        el.textContent = val;
                    }
                }
            });
            statsObs.disconnect();
        }
    });
},{threshold:0.5});
statsObs.observe(document.getElementById('s1'));

// ─── HERO LIVE SPEED COUNTER (animated count + live fluctuation) ───
(function(){
    const el = document.getElementById('liveSpeedCounter');
    if(!el) return;

    let current = 0;
    const target = parseInt(el.getAttribute('data-target')) || 1000;
    const duration = 2000;
    const step = target / (duration / 16);
    let countUp;
    
    let lastTime = 0;
    function animate(time) {
        if (!lastTime) lastTime = time;
        const delta = time - lastTime;
        
        if (delta >= 16) {
            current += step;
            if (current >= target) {
                el.textContent = target.toLocaleString();
                startFluctuation();
                return;
            }
            el.textContent = Math.floor(current).toLocaleString();
            lastTime = time;
        }
        countUp = requestAnimationFrame(animate);
    }
    countUp = requestAnimationFrame(animate);

    function startFluctuation() {
        setInterval(() => {
            const fluctuation = Math.floor(Math.random() * 80) - 40;
            const display = Math.max(920, Math.min(1024, target + fluctuation));
            el.textContent = display.toLocaleString();
        }, 2500);
    }
})();

// ─── LATENCY COUNTER ───
(function(){
    const el = document.getElementById('latencyCounter');
    if(!el) return;
    let current = 0;
    const target = parseInt(el.getAttribute('data-target')) || 3;
    const timer = setInterval(() => {
        current++;
        el.textContent = current + 'ms';
        if(current >= target) {
            clearInterval(timer);
            setInterval(() => {
                el.textContent = (Math.floor(Math.random()*3)+2) + 'ms';
            }, 3000);
        }
    }, 60);
})();

// ─── CLIENT COUNTER ───
(function(){
    const el = document.getElementById('clientCounter');
    if(!el) return;
    const target = parseInt(el.getAttribute('data-target')) || 1200;
    animateCount(el, target, '+', 2000);
})();

// ─── OLD SPEED RING (kept for stats section) ───
const speedObs = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
        if(e.isIntersecting){ speedObs.disconnect(); }
    });
},{threshold:0.5});
const speedEl = document.getElementById('speedCounter');
if(speedEl) speedObs.observe(speedEl);

// ─── BANNER SLIDER LOGIC ───
function initBannerSlider() {
    const slides = document.querySelectorAll('.banner-slide');
    const dots = document.querySelectorAll('.banner-dot');
    if (slides.length === 0) return;

    let currentSlide = 0;
    let slideInterval;

    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        currentSlide = index;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
        goToSlide((currentSlide + 1) % slides.length);
    }

    function startSlider() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            goToSlide(index);
            clearInterval(slideInterval);
            startSlider();
        });
    });

    startSlider();
}

// ─── MOBILE SIDEBAR ───
(function(){
    const hamburger = document.getElementById('navHamburger');
    const sidebar   = document.getElementById('mobileSidebar');
    const overlay   = document.getElementById('mobileOverlay');
    const closeBtn  = document.getElementById('sidebarClose');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('open');
        hamburger.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
        hamburger.classList.remove('open');
        document.body.style.overflow = '';
    }

    hamburger && hamburger.addEventListener('click', openSidebar);
    closeBtn  && closeBtn.addEventListener('click', closeSidebar);
    overlay   && overlay.addEventListener('click', closeSidebar);

    sidebar && sidebar.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', closeSidebar);
    });

    document.addEventListener('keydown', e => { if(e.key === 'Escape') closeSidebar(); });
})();

// ─── NAVBAR SCROLL CLASS ───
(function(){
    const nav = document.getElementById('glassNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });
})();

// ─── INIT ───
document.addEventListener('DOMContentLoaded', () => {
    initBannerSlider();
});
</script>


</body>
</html>
