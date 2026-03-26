<style>

/* ================= UTILS ================= */
:root {
    --rk-primary: #223a66;
    --rk-accent: #e12454;
    --rk-light-blue: #f0f4f9;
    --rk-glass: rgba(255, 255, 255, 0.95);
    /* --rk-border: #e1e7f0; */
}

/* ================= FLOAT BUTTON ================= */
.chat-toggle {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: var(--rk-primary);
    background: linear-gradient(135deg, var(--rk-primary) 0%, #1a2e52 100%);
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(34,58,102,0.3);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}
.chat-toggle:hover {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 15px 35px rgba(34,58,102,0.4);
}
.chat-toggle i {
    transition: transform 0.4s ease;
}
.chat-toggle.active i {
    transform: rotate(180deg);
}

/* ================= CHAT BOX ================= */
.chat-box {
    position: fixed;
    bottom: 105px;
    right: 30px;
    width: 380px;
    height: 550px;
    background: var(--rk-glass);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    z-index: 9998;
    transform-origin: bottom right;
    transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    border: 1px solid rgba(255,255,255,0.4);
    opacity: 0;
    pointer-events: none;
    transform: scale(0.9) translateY(20px);
}
.chat-box.show {
    opacity: 1;
    pointer-events: auto;
    transform: scale(1) translateY(0);
}

/* ================= HEADER ================= */
.chat-header {
    background: var(--rk-primary);
    background: linear-gradient(135deg, var(--rk-primary) 0%, #1a2e52 100%);
    color: white;
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}
.chat-header-info {
    display: flex;
    align-items: center;
    gap: 12px;
}
.chat-header-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.chat-header-title h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: white !important;
}
.chat-header-title span {
    font-size: 12px;
    opacity: 0.8;
    display: flex;
    align-items: center;
    gap: 4px;
}
.chat-header-title span::before {
    content: '';
    width: 8px;
    height: 8px;
    background: #4ade80;
    border-radius: 50%;
    display: inline-block;
}

.chat-close-btn {
    background: rgba(255,255,255,0.1);
    border: none;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
}
.chat-close-btn:hover {
    background: rgba(255,255,255,0.2);
}

/* ================= MESSAGE AREA ================= */
.chat-messages {
    flex: 1;
    padding: 25px;
    overflow-y: auto;
    background: #f8fafd;
    display: flex;
    flex-direction: column;
    gap: 15px;
    scrollbar-width: thin;
    scrollbar-color: rgba(34,58,102,0.1) transparent;
}
.chat-messages::-webkit-scrollbar {
    width: 6px;
}
.chat-messages::-webkit-scrollbar-thumb {
    background: rgba(34,58,102,0.1);
    border-radius: 10px;
}

/* ================= MESSAGE ================= */
.message {
    max-width: 85%;
    display: flex;
    flex-direction: column;
    animation: messageIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}

@keyframes messageIn {
    from { opacity: 0; transform: translateY(10px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.message.user {
    align-self: flex-end;
}
.message.bot {
    align-self: flex-start;
}

.bubble {
    padding: 12px 18px;
    border-radius: 18px;
    line-height: 1.6;
    font-size: 14px;
    position: relative;
}

/* USER Bubble */
.user .bubble {
    background: var(--rk-accent);
    color: white;
    border-bottom-right-radius: 4px;
    box-shadow: 0 4px 15px rgba(225,36,84,0.2);
}

/* BOT Bubble */
.bot .bubble {
    background: white;
    color: #444;
    border-bottom-left-radius: 4px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.03);
}

.bot-icon {
    width: 28px;
    height: 28px;
    background: var(--rk-primary);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    margin-bottom: 5px;
}

/* ================= INPUT ================= */
.chat-footer {
    padding: 20px;
    background: white;
    border-top: 1px solid #f0f0f0;
}

.chat-input-wrapper {
    display: flex;
    align-items: center;
    background: #f1f4f9;
    border-radius: 14px;
    padding: 5px 5px 5px 15px;
    transition: all 0.3s;
    border: 1px solid transparent;
}
.chat-input-wrapper:focus-within {
    background: white;
    border-color: var(--rk-primary);
    box-shadow: 0 5px 15px rgba(34,58,102,0.08);
}

.chat-input-wrapper input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 10px 0;
    outline: none;
    font-size: 14px;
    color: #444;
}

.send-btn {
    background: var(--rk-primary);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
}
.send-btn:hover {
    background: var(--rk-accent);
    transform: scale(1.05);
}

.chat-info-alert {
    margin-top: 12px;
    padding: 8px 12px;
    background: #fffbe6;
    border: 1px solid #ffe58f;
    border-radius: 10px;
    font-size: 11px;
    color: #856404;
    display: flex;
    gap: 8px;
    align-items: flex-start;
}

@media (max-width: 480px) {
    .chat-box {
        width: calc(100% - 40px);
        height: 80vh;
        right: 20px;
        bottom: 90px;
    }
}

</style>

<!-- ================= CHAT BUTTON ================= -->
<button id="chatToggle" class="chat-toggle">
    <i class="icofont-ui-messaging"></i>
</button>

<!-- ================= CHAT BOX ================= -->
<div id="chatBox" class="chat-box">

    <div class="chat-header">
        <div class="chat-header-info">
            <div class="chat-header-avatar">
                <i class="icofont-nurse"></i>
            </div>
            <div class="chat-header-title">
                <h4>RuangKonsul AI</h4>
                <span>Online</span>
            </div>
        </div>
        <button id="closeChat" class="chat-close-btn">
            <i class="icofont-close"></i>
        </button>
    </div>

    <div id="chatbotMessages" class="chat-messages"></div>

    <div class="chat-footer">
        <div class="chat-input-wrapper">
            <input type="text" id="chatInput" placeholder="Tulis pesan untuk konsultasi..." autocomplete="off" />
            <button id="sendMessage" class="send-btn">
                <i class="icofont-paper-plane"></i>
            </button>
        </div>
        
        <div class="chat-info-alert">
            <i class="icofont-info-circle" style="font-size: 14px;"></i>
            <span>Asisten AI melayani pertanyaan seputar kesehatan & layanan RuangKonsul secara otomatis.</span>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const chatToggle   = document.getElementById("chatToggle");
    const chatBox      = document.getElementById("chatBox");
    const closeChat    = document.getElementById("closeChat");
    const sendBtn      = document.getElementById("sendMessage");
    const chatInput    = document.getElementById("chatInput");
    const chatbotMessages = document.getElementById("chatbotMessages");

    chatToggle.addEventListener("click", () => {
        chatBox.classList.toggle("show");
        chatToggle.classList.toggle("active");
        if(chatBox.classList.contains("show")) chatInput.focus();
    });
    
    closeChat.addEventListener("click", () => {
        chatBox.classList.remove("show");
        chatToggle.classList.remove("active");
    });

    sendBtn.addEventListener("click", sendMessage);
    chatInput.addEventListener("keypress", e => {
        if(e.key === "Enter") sendMessage();
    });

    /* welcome message */
    setTimeout(() => {
        appendMessage("Bot","Halo 👋 Selamat datang di <b>RuangKonsul</b>. Saya asisten AI yang siap membantu menjawab pertanyaan Anda seputar <b>kesehatan</b> dan layanan kami. Apa yang bisa saya bantu hari ini?");
    }, 500);

    function sendMessage() {
        let message = chatInput.value.trim();
        if (!message) return;

        appendMessage("Anda", message);
        chatInput.value = "";

        fetch("/chatbot/send", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message: message })
        })
        .then(res => {
            if (!res.ok) {
                console.error("HTTP Error:", res.status, res.statusText);
                return res.json().then(data => {
                    throw new Error(`HTTP ${res.status}: ${data.reply || res.statusText}`);
                }).catch(parseErr => {
                    throw new Error(`HTTP ${res.status}`);
                });
            }
            return res.json();
        })
        .then(data => {
            if (data.reply) {
                appendMessage("Bot", data.reply);
            } else {
                console.error("No reply in response:", data);
                appendMessage("Bot","Maaf, tidak ada balasan dari server.");
            }
        })
        .catch(err => {
            console.error("Chatbot Error:", err.message || err);
            appendMessage("Bot", err.message || "Terjadi kesalahan koneksi. Silakan periksa koneksi internet atau coba lagi nanti.");
        });
    }

    function appendMessage(sender, text) {
        const wrapper = document.createElement("div");
        wrapper.className = sender === "Anda" ? "message user" : "message bot";

        if (sender !== "Anda") {
            const botIcon = document.createElement("div");
            botIcon.className = "bot-icon";
            botIcon.innerHTML = '<i class="icofont-nurse"></i>';
            wrapper.appendChild(botIcon);
        }

        const bubble = document.createElement("div");
        bubble.className = "bubble";
        
        // Simple Markdown-like parsing for bold and bullet points
        let processedText = text
            .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>') // **bold**
            .replace(/^\s*-\s+(.*)$/gm, '• $1<br/>') // - list
            .replace(/\n/g, '<br/>'); // newlines

        bubble.innerHTML = processedText;

        wrapper.appendChild(bubble);
        chatbotMessages.appendChild(wrapper);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function(){

  document.querySelectorAll('.add-to-cart-btn').forEach(btn => {

    btn.addEventListener('click', function (e) {

      e.preventDefault();

      // Anti double click
      if(this.disabled) return;

      const produkId = this.dataset.id;
      const url = "{{ route('cart.add') }}";
      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const button = this;

      button.disabled = true;

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
          produk_id: produkId,
          qty: 1
        })
      })
      .then(res => res.json())
      .then(data => {

        if(data.success){

          button.innerHTML = "✔ Added";
          button.style.background = "#16a34a";
          button.style.borderColor = "#16a34a";
          button.style.color = "white";

          const countEl = document.getElementById('cart-count');
          if(countEl){
            countEl.textContent = data.cart_count;
          }

        } else {
          alert(data.message);
          button.disabled = false;
        }

      })
      .catch(error => {
        console.error(error);
        alert("Terjadi kesalahan.");
        button.disabled = false;
      });

    });

  });

});
</script>