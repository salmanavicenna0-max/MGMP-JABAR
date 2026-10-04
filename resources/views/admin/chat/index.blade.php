@extends('layouts.app')

@section('title', 'Live Chat CS — Admin')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950 flex flex-col">
    <!-- Header -->
    <div class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-headset text-mgmp"></i> Live Chat CS
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Balas pesan pengunjung website.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm flex h-[600px]">
            
            <!-- Sidebar: Session List -->
            <div class="w-1/3 border-r border-slate-200 dark:border-slate-800 flex flex-col bg-slate-50 dark:bg-slate-950">
                <div class="p-4 border-b border-slate-200 dark:border-slate-800 font-bold text-slate-800 dark:text-slate-200 flex justify-between items-center bg-white dark:bg-slate-900">
                    Daftar Percakapan
                    <div class="flex items-center gap-2">
                        <button onclick="deleteAllSessions()" class="text-xs px-2 py-1 bg-red-50 text-red-500 hover:bg-red-100 rounded border border-red-200 transition" title="Hapus semua riwayat">
                            <i class="fas fa-trash-alt mr-1"></i>Hapus Semua
                        </button>
                        <button onclick="window.location.reload()" class="text-mgmp hover:text-mgmp-dark" title="Refresh">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="flex-grow overflow-y-auto custom-scrollbar" id="session-list">
                    @forelse($sessions as $session)
                    <div class="p-4 border-b border-slate-200 dark:border-slate-800 cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 transition session-item group" onclick="loadChat('{{ $session->id }}')">
                        <div class="flex justify-between items-start mb-1">
                            <span class="font-semibold text-slate-800 dark:text-slate-200 truncate">{{ $session->visitor_name }}</span>
                            <div class="flex items-center gap-1.5">
                                @if($session->status == 'active')
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-200 text-slate-600 dark:bg-slate-700 dark:text-slate-300">Selesai</span>
                                @endif
                                <button onclick="event.stopPropagation(); deleteSession('{{ $session->id }}')" class="opacity-0 group-hover:opacity-100 transition text-red-400 hover:text-red-600 p-0.5" title="Hapus sesi ini">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 truncate">
                            {{ $session->visitor_email ?? 'Tanpa Email' }}
                        </div>
                        <div class="text-[10px] text-slate-400 mt-2 text-right">
                            {{ $session->updated_at->diffForHumans() }}
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-slate-500 text-sm">
                        Belum ada pesan masuk.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Chat Window -->
            <div class="w-2/3 flex flex-col bg-white dark:bg-slate-900 relative">
                <!-- Header -->
                <div class="p-4 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex justify-between items-center shadow-sm z-10" id="chat-header" style="display:none;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-mgmp/10 flex items-center justify-center text-mgmp font-bold text-lg" id="chat-avatar"></div>
                        <div>
                            <h3 class="font-bold text-slate-800 dark:text-slate-200 leading-tight" id="chat-name">-</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400" id="chat-email">-</p>
                        </div>
                    </div>
                    <button id="close-chat-btn" onclick="closeSession()" class="text-xs px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 rounded border border-red-200 dark:border-red-800 transition">
                        Akhiri Chat
                    </button>
                </div>

                <!-- Messages -->
                <div class="flex-grow p-4 overflow-y-auto custom-scrollbar bg-slate-50/50 dark:bg-slate-900/50 space-y-4" id="chat-messages">
                    <div class="h-full flex flex-col items-center justify-center text-slate-400">
                        <i class="far fa-comments text-5xl mb-3 opacity-50"></i>
                        <p>Pilih percakapan dari daftar di sebelah kiri</p>
                    </div>
                </div>

                <!-- Input -->
                <div class="p-4 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900" id="chat-input-area" style="display:none;">
                    <form onsubmit="sendReply(event)" class="flex gap-2">
                        <input type="text" id="reply-input" class="flex-grow px-4 py-2 bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp transition" placeholder="Ketik balasan..." autocomplete="off" required>
                        <button type="submit" class="w-10 h-10 bg-mgmp text-white rounded-lg flex items-center justify-center hover:bg-mgmp-dark transition shrink-0">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

                <!-- Loading Overlay -->
                <div id="chat-loading" class="absolute inset-0 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm z-20 flex items-center justify-center hidden">
                    <i class="fas fa-spinner fa-spin text-3xl text-mgmp"></i>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    let currentSessionId = null;
    let pollInterval    = null;
    let lastMsgId       = 0;
    let isPolling       = false;   // prevent concurrent fetch
    let isSending       = false;   // prevent double-send

    const BASE_URL = `{{ str_replace('http://', 'https://', url('admin/chat')) }}`;

    /* ── Load a session ── */
    function loadChat(id) {
        if (pollInterval) clearInterval(pollInterval);
        currentSessionId = id;
        lastMsgId        = 0;
        isPolling        = false;

        document.getElementById('chat-loading').classList.remove('hidden');

        fetch(`${BASE_URL}/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('chat-loading').classList.add('hidden');
                document.getElementById('chat-header').style.display = 'flex';

                document.getElementById('chat-name').innerText   = data.session.visitor_name;
                document.getElementById('chat-email').innerText  = data.session.visitor_email || 'Tanpa Email';
                document.getElementById('chat-avatar').innerText = data.session.visitor_name.charAt(0).toUpperCase();

                if (data.session.status === 'closed') {
                    document.getElementById('chat-input-area').style.display  = 'none';
                    document.getElementById('close-chat-btn').style.display   = 'none';
                } else {
                    document.getElementById('chat-input-area').style.display  = 'block';
                    document.getElementById('close-chat-btn').style.display   = 'block';
                }

                renderMessages(data.messages);

                // Track highest message id we already rendered
                if (data.messages.length > 0) {
                    lastMsgId = Math.max(...data.messages.map(m => m.id));
                }

                // Start incremental polling — only new messages
                pollInterval = setInterval(pollNewMessages, 3000);
            });
    }

    /* ── Render all messages (full refresh) ── */
    function renderMessages(messages) {
        const container = document.getElementById('chat-messages');
        container.innerHTML = '';

        if (messages.length === 0) {
            container.innerHTML = '<div class="text-center text-slate-400 text-xs py-4">Belum ada pesan.</div>';
            return;
        }

        messages.forEach(msg => appendMsgBubble(msg, container));
        container.scrollTop = container.scrollHeight;
    }

    /* ── Append a single message bubble ── */
    function appendMsgBubble(msg, container) {
        container = container || document.getElementById('chat-messages');
        const isVisitor = msg.sender === 'visitor';
        const align     = isVisitor ? 'justify-start' : 'justify-end';
        const bgClass   = isVisitor
            ? 'bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 rounded-br-xl'
            : 'bg-mgmp text-white rounded-bl-xl shadow-md';

        const html = `
            <div class="flex ${align}">
                <div class="max-w-[75%]">
                    <div class="px-4 py-2 text-sm rounded-t-xl ${bgClass}">
                        ${msg.message}
                    </div>
                    <div class="text-[9px] text-slate-400 mt-1 ${isVisitor ? 'text-left' : 'text-right'} px-1">
                        ${new Date(msg.created_at).toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})}
                    </div>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        container.scrollTop = container.scrollHeight;
    }

    /* ── Poll ONLY new messages (incremental) ── */
    function pollNewMessages() {
        if (!currentSessionId || isPolling) return;   // skip if already fetching
        isPolling = true;

        fetch(`${BASE_URL}/${currentSessionId}?after=${lastMsgId}`)
            .then(res => res.json())
            .then(data => {
                if (data.session.status === 'closed') {
                    document.getElementById('chat-input-area').style.display = 'none';
                    document.getElementById('close-chat-btn').style.display  = 'none';
                }

                // Only append messages newer than what we already have
                const newMsgs = (data.messages || []).filter(m => m.id > lastMsgId);
                newMsgs.forEach(m => {
                    appendMsgBubble(m);
                    lastMsgId = Math.max(lastMsgId, m.id);
                });
            })
            .finally(() => { isPolling = false; });
    }

    /* ── Send a reply ── */
    function sendReply(e) {
        e.preventDefault();
        if (isSending) return;

        const input   = document.getElementById('reply-input');
        const message = input.value.trim();
        if (!message || !currentSessionId) return;

        isSending     = true;
        input.value   = '';
        input.disabled = true;

        fetch(`${BASE_URL}/${currentSessionId}/reply`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        })
        .then(res => res.json())
        .then(data => {
            if (data.message) {
                appendMsgBubble(data.message);
                lastMsgId = Math.max(lastMsgId, data.message.id);
            }
        })
        .finally(() => {
            isSending      = false;
            input.disabled = false;
            input.focus();
        });
    }

    /* ── Close session ── */
    function closeSession() {
        if (!confirm('Yakin ingin mengakhiri chat ini?')) return;
        fetch(`${BASE_URL}/${currentSessionId}/close`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => window.location.reload());
    }

    /* ── Delete one session ── */
    function deleteSession(id) {
        if (!confirm('Hapus sesi percakapan ini beserta semua pesannya?')) return;
        fetch(`${BASE_URL}/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        }).then(r => r.json()).then(data => {
            if (data.success) {
                if (currentSessionId == id) {
                    currentSessionId = null;
                    if (pollInterval) clearInterval(pollInterval);
                    document.getElementById('chat-header').style.display     = 'none';
                    document.getElementById('chat-input-area').style.display = 'none';
                    document.getElementById('chat-messages').innerHTML = `
                        <div class="h-full flex flex-col items-center justify-center text-slate-400">
                            <i class="far fa-comments text-5xl mb-3 opacity-50"></i>
                            <p>Pilih percakapan dari daftar di sebelah kiri</p>
                        </div>`;
                }
                window.location.reload();
            }
        });
    }

    /* ── Delete all sessions ── */
    function deleteAllSessions() {
        if (!confirm('Hapus SEMUA riwayat chat? Tindakan ini tidak bisa dibatalkan!')) return;
        fetch(`${BASE_URL}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        }).then(r => r.json()).then(data => {
            if (data.success) window.location.reload();
        });
    }
</script>
@endsection
