document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('toggleChatBtn');
  const chatContainer = document.getElementById('chatContainer');
  const closeBtn = document.getElementById('closeChatBtn');
  const form = document.getElementById('chatForm');
  const input = document.getElementById('messageInput');
  const messages = document.getElementById('chatMessages');

  const API_URL = 'https://tec-message-ws.onrender.com/api/v1/messages'; // endpoint de mensajeria

  toggleBtn.addEventListener('click', () => {
    chatContainer.style.display = 'block';
  });

  closeBtn.addEventListener('click', () => {
    chatContainer.style.display = 'none';
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const userMsg = input.value.trim();
    if (!userMsg) return;

    appendMessage(userMsg, 'user');
    input.value = '';
    appendMessage('Escribiendo...', 'bot', true);

    try {
      let uuid = self.crypto.randomUUID();
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ senderId: uuid, text: userMsg, assistantName:'tec_procesos_bot', createdBy:'app-wps' })
      });

      const data = await response.json();
      removeTypingMessage();
      appendMessage(data.data.text || 'Lo siento, no entend\u00ed.', 'bot');
    } catch (err) {
      removeTypingMessage();
      appendMessage('Error al conectar. Intenta más tarde.', 'bot');
    }
  });

  function appendMessage(text, sender, typing = false) {
    const div = document.createElement('div');
    div.className = `message ${sender}`;
    if (typing) div.dataset.typing = 'true';
    div.textContent = text;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
  }

  function removeTypingMessage() {
    const typingMsg = messages.querySelector('[data-typing="true"]');
    if (typingMsg) typingMsg.remove();
  }
});
