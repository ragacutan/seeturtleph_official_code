function openChat() {
            document.getElementById('message-button').style.display = 'none';
            document.getElementById('chat-container').style.display = 'block';
        }

        function returnToMessageButton() {
            document.getElementById('message-button').style.display = 'block';
            document.getElementById('chat-container').style.display = 'none';
        }