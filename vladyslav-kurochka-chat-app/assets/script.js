document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message');

    // Загрузка сообщений
    async function loadMessages() {
        const response = await fetch('./api/get_messages.php');
        const messages = await response.json();

        chatBox.innerHTML = '';
        messages.forEach(msg => {
            const messageElement = document.createElement('div');
            messageElement.className = 'message';
            messageElement.innerHTML = `<strong>${msg.username}:</strong> ${msg.message} <em>${msg.created_at}</em>`;
            chatBox.appendChild(messageElement);
        });

        // Прокручиваем вниз
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Отправка сообщения
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const message = messageInput.value;
        try {
            const response = await fetch('./api/send_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `message=${encodeURIComponent(message)}`
            });

            const result = await response.json();
            if (result.success) {
                messageInput.value = '';
                loadMessages();
            } else {
                console.error('Ошибка при отправке сообщения:', result.error);
                alert(result.error);
            }
        } catch (error) {
            console.error('Ошибка подключения:', error);
            alert('Ошибка подключения. Проверьте ваш сервер.');
        }
    });

    // Обновляем сообщения каждые 2 секунды
    setInterval(loadMessages, 2000);
    loadMessages();
});
