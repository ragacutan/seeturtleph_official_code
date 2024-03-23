document.addEventListener("DOMContentLoaded", function () {
    const chatBox = document.getElementById("chat-box");
    const userInput = document.getElementById("user-input");
    const sendButton = document.getElementById("send-button");

    // Predefined questions and responses
    const predefinedQuestions = [
        "How are you?",
        "What is your name?",
        "How can I contact support?",
        "What is Project CURMA?",
        "How can I volunteer for Project CURMA?",
        "Who are the developers of this web app?",
        "CURMA's Goal",
        "CURMA's Tagline",

    ];

    // Initialize chat history
    const chatHistory = [];

    // Display predefined questions at the start
    displayQuestions();

    sendButton.addEventListener("click", function () {
        const userMessage = userInput.value.trim();
        if (userMessage === "") return;

        // Add user's question to chat history
        chatHistory.push({ sender: "You", message: userMessage });

        // Display user message in the chat box
        appendMessage("You", userMessage, "user-message");

        // Remove the asked question from the list of predefined questions
        const questionIndex = predefinedQuestions.indexOf(userMessage);
        if (questionIndex !== -1) {
            predefinedQuestions.splice(questionIndex, 1);
        }

        // Send bot response
        setTimeout(function () {
            const botResponse = getBotResponse(userMessage);
            appendMessage("Chatbot", botResponse, "bot-message");

            // Clear the input field
            userInput.value = "";
        }, 1000); // Simulated response delay
    });

    function appendMessage(sender, message, messageClass) {
        const messageDiv = document.createElement("div");
        messageDiv.innerHTML = `<strong>${sender}:</strong> ${message}`;
        messageDiv.classList.add(messageClass);
        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function displayQuestions() {
        // Display predefined questions as buttons only at the start
        predefinedQuestions.forEach(function (question) {
            appendButton(question);
        });
    }

    function appendButton(question) {
        const button = document.createElement("button");
        button.textContent = question;
        button.classList.add("question-button");
        button.addEventListener("click", function () {
            userInput.value = question;
        });
        chatBox.appendChild(button);
    }

    // Function to send a message when Enter key is pressed
function sendMessage(event) {
    if (event.key === "Enter") {
        const userMessage = document.getElementById("user-input").value;
        if (userMessage.trim() !== "") {
            // Add user's message to the chatbox
            addMessage("user", userMessage);

            // Process the user's message (you can handle this part as needed)
            processUserMessage(userMessage);

            // Clear the input field
            document.getElementById("user-input").value = "";
        }
    }
}


    // Send bot response
setTimeout(function () {
    const botResponse = getBotResponse(userMessage);
    appendMessage("ChatBot", botResponse, "bot-message");
    // Clear the input field
    userInput.value = "";
}, 1000); // Simulated response delay

    function getBotResponse(userMessage) {
        // Replace this with your logic to generate bot responses
        const responses = {
            "Hi": "Hello! How can I assist you today?",
            "Hello": "Hi there! How can I help you?",
            "How are you?": "I'm just a chatbot, so I don't have feelings, but I'm here to help you with any questions you have.",
            "What is your name?": "My name is SEE Chatbot.",
            "How can I contact support?": "You can contact support at (+63) 9423664519 or email us at curma@sifcare.org",
            "CURMA's Goal": "Through education and livelihood programs, we turned former poachers into protectors of sea turtles, releasing over 35,000 hatchlings since we started. Now, we are on a vision to release 1 Million Hatchlings by 2030, replicating our successful model nationwide. We believe that our holistic approach focused on sea turtle conservation, guided by science-driven research and community development, along with other initiatives such as waste management, coastal forest/mangroves reforestation, and education, is the key to our success.",
            "What is Project CURMA?": "CURMA is a marine turtle conservation initiative that was established in 2010. Based in San Juan, La Union, the organization is committed to protecting endangered sea turtles and promoting sustainable development in the region.",
            "How can I volunteer for Project CURMA?": "To volunteer for Project CURMA, you can typically start by visiting their official website or contacting their organization directly. They often provide information on volunteer opportunities, application processes, and requirements on their website.",
            "Who are the developers of this web app?": "The web app was developed by the students from DMMMSU-Mid La Union Campus, with Dennis Loren P. Tacubaza as the Front End Developer, Ram Adrian Gacutan as the Back End Developer, and Rizalyn Florague and Lily Ann Ugay as the technical writers.",
            "CURMA's Tagline": "Respect, Responsibility, and Care in Action",
        };
        return responses[userMessage] || "I'm sorry, I don't understand that.";
    }
});
