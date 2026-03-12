@extends('layouts.app')

@section('title', 'Konsultasi Medis | RuangKonsul')

@section('content')

@push('styles')
<style>
    :root {
        --rk-primary: #223a66;
        --rk-accent: #e12454;
        --rk-success: #28a745;
        --rk-bg-light: #f4f7fb;
    }

    body {
        background-color: var(--rk-bg-light);
    }

    /* Main Chat Layout */
    .chat-container-modern {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        height: calc(100vh - 160px);
        min-height: 500px;
        background: white;
        border-radius: 24px;
        box-shadow: 0 15px 45px rgba(34, 58, 102, 0.08);
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
    }

    /* Top Navigation / Header */
    .chat-header-modern {
        padding: 15px 25px;
        background: white;
        border-bottom: 1px solid #f0f3f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 10;
    }

    .doctor-profile-sm {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .doc-avatar-wrapper {
        position: relative;
        width: 50px;
        height: 50px;
    }

    .doc-avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 15px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .online-indicator {
        position: absolute;
        bottom: -2px;
        right: -2px;
        width: 14px;
        height: 14px;
        background: var(--rk-success);
        border: 3px solid white;
        border-radius: 50%;
    }

    .doc-meta h6 {
        margin: 0;
        font-weight: 700;
        color: var(--rk-primary);
        font-size: 15px;
    }

    .doc-meta span {
        font-size: 11px;
        color: var(--rk-accent);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .session-info {
        text-align: right;
    }

    .session-id {
        font-size: 11px;
        color: #adb5bd;
        font-family: monospace;
        display: block;
    }

    /* Messages Display Area */
    .messages-viewport {
        flex: 1;
        overflow-y: auto;
        padding: 30px;
        background: #fdfdfe;
        display: flex;
        flex-direction: column;
        gap: 20px;
        scroll-behavior: smooth;
    }

    .messages-viewport::-webkit-scrollbar { width: 5px; }
    .messages-viewport::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }

    /* Message Bubbles */
    .msg-row {
        display: flex;
        width: 100%;
    }

    .msg-bubble {
        max-width: 75%;
        padding: 12px 18px;
        font-size: 14px;
        line-height: 1.6;
        position: relative;
    }

    /* Received (Doctor) */
    .msg-row.received {
        justify-content: flex-start;
    }
    .msg-row.received .msg-bubble {
        background: white;
        color: #444;
        border-radius: 4px 20px 20px 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #f0f3f7;
    }

    /* Sent (Customer) */
    .msg-row.sent {
        justify-content: flex-end;
    }
    .msg-row.sent .msg-bubble {
        background: linear-gradient(135deg, var(--rk-primary), #2b4c7e);
        color: white;
        border-radius: 20px 4px 20px 20px;
        box-shadow: 0 8px 20px rgba(34, 58, 102, 0.15);
    }

    .msg-time {
        display: block;
        font-size: 10px;
        margin-top: 5px;
        opacity: 0.7;
    }
    .msg-row.sent .msg-time { text-align: right; }

    /* Input Footer */
    .chat-input-modern {
        padding: 20px 25px;
        background: white;
        border-top: 1px solid #f0f3f7;
    }

    .input-box-wrapper {
        display: flex;
        align-items: center;
        background: #f8fafd;
        border: 1px solid #e1e9f1;
        border-radius: 50px;
        padding: 5px 5px 5px 20px;
        transition: all 0.3s;
    }
    .input-box-wrapper:focus-within {
        border-color: var(--rk-primary);
        box-shadow: 0 0 0 4px rgba(34, 58, 102, 0.05);
        background: white;
    }

    .main-input {
        border: none;
        background: transparent;
        flex: 1;
        padding: 10px 0;
        outline: none;
        font-size: 14px;
        color: var(--rk-primary);
    }

    .btn-send-modern {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--rk-accent);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(225, 36, 84, 0.3);
    }
    .btn-send-modern:hover {
        transform: scale(1.05) rotate(-10deg);
        background: #f23d6a;
    }
    .btn-send-modern:disabled {
        background: #ccc;
        box-shadow: none;
    }

    /* Welcome State */
    .chat-empty-state {
        margin: auto;
        text-align: center;
        max-width: 300px;
    }
    .empty-icon {
        font-size: 50px;
        margin-bottom: 20px;
        display: block;
    }

    /* Loading Spinner */
    .dot-loader {
        display: flex;
        gap: 4px;
    }
    .dot {
        width: 6px;
        height: 6px;
        background: white;
        border-radius: 50%;
        animation: dotPulse 1.4s infinite ease-in-out both;
    }
    .dot:nth-child(1) { animation-delay: -0.32s; }
    .dot:nth-child(2) { animation-delay: -0.16s; }
    @keyframes dotPulse {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1.0); }
    }

    /* Back Button */
    .btn-back-header {
        border: none;
        background: #f1f4f9;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--rk-primary);
        transition: all 0.2s;
        margin-right: 15px;
    }
    .btn-back-header:hover {
        background: var(--rk-primary);
        color: white;
    }

    @media (max-width: 768px) {
        .chat-container-modern {
            height: calc(100vh - 100px);
            border-radius: 0;
        }
        .msg-bubble { max-width: 85%; }
    }
</style>
@endpush

<div class="container py-4 px-md-0">
    <div class="chat-container-modern">
        
        <!-- Header -->
        <header class="chat-header-modern">
            <div class="d-flex align-items-center">
                <a href="{{ url()->previous() }}" class="btn-back-header">
                    <i class="icofont-arrow-left"></i>
                </a>
                <div class="doctor-profile-sm">
                    <div class="doc-avatar-wrapper">
                        @php
                            $imagePath = file_exists(public_path($dokter->gambar)) ? asset($dokter->gambar) : asset('storage/' . $dokter->gambar);
                        @endphp
                        <img src="{{ $imagePath }}" class="doc-avatar-img" alt="">
                        <div class="online-indicator"></div>
                    </div>
                    <div class="doc-meta">
                        <h6>Dr. {{ $dokter->dokterName }}</h6>
                        <span>{{ ucwords($dokter->namaBidang) }}</span>
                    </div>
                </div>
            </div>
            <div class="session-info d-none d-sm-block">
                <span class="session-id">SID: {{ $chat->chatDokterId ?? 'N/A' }}</span>
                <span class="badge badge-pill badge-light text-muted border px-3" style="font-size: 10px;">Enkripsi End-to-End</span>
            </div>
        </header>

        <!-- Viewport -->
        <main class="messages-viewport" id="chatViewport">
            @if($chat)
                <div class="chat-empty-state" id="welcomeMsg">
                    <span class="empty-icon">🩺</span>
                    <h6 class="fw-bold text-primary-rk">Konsultasi Dimulai</h6>
                    <p class="text-muted small">Tuliskan gejala atau keluhan Anda untuk mulai berkonsultasi dengan dr. {{ $dokter->dokterName }}.</p>
                </div>
            @else
                <div class="chat-empty-state">
                    <span class="empty-icon">🔒</span>
                    <h6 class="fw-bold">Sesi Terkunci</h6>
                    <p class="text-muted small">Mohon selesaikan langkah sebelumnya untuk mulai chatting.</p>
                </div>
            @endif
        </main>

        <!-- Footer Input -->
        <footer class="chat-input-modern">
            <div class="input-box-wrapper">
                <input type="text" 
                       id="msgInputMain" 
                       class="main-input" 
                       placeholder="{{ $chat ? 'Ketik pesan konsultasi Anda...' : 'Sesi tidak tersedia' }}"
                       {{ !$chat ? 'disabled' : '' }}
                       autocomplete="off">
                <button id="btnSendMain" class="btn-send-modern" {{ !$chat ? 'disabled' : '' }}>
                    <i class="icofont-paper-plane"></i>
                </button>
            </div>
            <div id="statusIndicator" class="text-center mt-2 small text-muted" style="display:none; font-size: 10px;">
                <i class="icofont-spinner-alt-3 icofont-spin"></i> Mengirim...
            </div>
        </header>

    </div>
</div>

@push('scripts')
<script>
    const viewport = document.getElementById('chatViewport');
    const input = document.getElementById('msgInputMain');
    const sendBtn = document.getElementById('btnSendMain');
    const statusIdx = document.getElementById('statusIndicator');

    @if($chat)
        const chatID = '{{ $chat->chatDokterId }}';
        const sendUrl = '{{ url("landing/dokter/message") }}/' + chatID + '/send';
        const getUrl = '{{ url("landing/dokter/message") }}/' + chatID + '/get';
        const csrfToken = '{{ csrf_token() }}';
    @endif

    let lastID = 0;
    let isSending = false;

    function renderMessage(msg, type) {
        // Remove welcome msg
        const welcome = document.getElementById('welcomeMsg');
        if(welcome) welcome.remove();

        const isMe = type === 'customer';
        const div = document.createElement('div');
        div.className = `msg-row ${isMe ? 'sent' : 'received'}`;
        
        div.innerHTML = `
            <div class="msg-bubble">
                ${msg.message || msg}
                <span class="msg-time">${msg.created_at || 'Baru saja'}</span>
            </div>
        `;

        viewport.appendChild(div);
        viewport.scrollTop = viewport.scrollHeight;

        if (msg.id && msg.id > lastID) lastID = msg.id;
    }

    async function pollMessages() {
        @if($chat)
        try {
            const res = await fetch(getUrl);
            const data = await res.json();
            if(data && data.length > 0) {
                data.filter(m => m.id > lastID).forEach(m => renderMessage(m, m.sender_type));
            }
        } catch(e) { console.error("Poll Error", e); }
        @endif
    }

    async function doSend() {
        const val = input.value.trim();
        if(!val || isSending) return;

        isSending = true;
        sendBtn.disabled = true;
        sendBtn.innerHTML = '<div class="dot-loader"><div class="dot"></div><div class="dot"></div></div>';
        
        try {
            const res = await fetch(sendUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ message: val })
            });
            const data = await res.json();
            if(data.success) {
                renderMessage(data.message, 'customer');
                if(data.reply) renderMessage(data.reply, 'dokter');
                input.value = '';
                input.focus();
            }
        } catch(e) { 
            alert("Gagal mengirim pesan.");
        } finally {
            isSending = false;
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="icofont-paper-plane"></i>';
        }
    }

    if(sendBtn) {
        sendBtn.addEventListener('click', doSend);
        input.addEventListener('keypress', e => { if(e.key === 'Enter') doSend(); });
        
        // Polling
        setInterval(pollMessages, 4000);
        pollMessages(); // Initial load
    }
</script>
@endpush

@endsection