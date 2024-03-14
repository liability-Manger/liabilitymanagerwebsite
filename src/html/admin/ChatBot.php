<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chatbot</title>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    }
    
    .chat-container {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    
    .chat-box {
        height: 300px;
        overflow-y: auto;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
    }
    
    input[type="text"] {
        width: calc(100% - 60px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    
    button {
        width: 60px;
        padding: 8px;
        margin-left: 10px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    
    button:hover {
        background-color: #0056b3;
    }
    
</style>
</head>
<body>
<div class="chat-container">
    <div class="chat-box" id="chat-box"></div>
    <input type="text" placeholder="Type a message..." id="user-input">
    <button onclick="sendMessage()">Send</button>
</div>
<script >
    const chatBox = document.getElementById('chat-box');
    const userInput = document.getElementById('user-input');

    let promptForEmail = false;
    let promptForMessage = false;
    let userEmail = '';
    let userMessage = '';
    
    function sendMessage() {
        const userMessage = userInput.value.trim();
        if (userMessage === '') return;
    
        displayMessage('user', userMessage);
        respondToMessage(userMessage);
    
        userInput.value = '';
    }
    
    function displayMessage(sender, message) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', sender);
        messageDiv.textContent = message;
        chatBox.appendChild(messageDiv);
    
        // Scroll to bottom of chat box
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    
    function respondToMessage(message) {
    let response;

    // Check if the message contains certain keywords and provide appropriate responses
    if (message.toLowerCase().includes('hello', 'hi','hawde', 'sub')) {
        response = "Hi there! How can I assist you today?";
    } else if (message.toLowerCase().includes('help')) {
        response = "Sure, I'm here to help with your business. What do you need assistance with?";
    } else if (message.toLowerCase().includes('business development')) {
        response = "Business development involves creating long-term value for an organization through strategic partnerships, exploring new markets, and increasing sales.";
    } else if (message.toLowerCase().includes('strategy')) {
        response = "Business strategy is a plan of action designed to achieve specific goals or objectives. It involves setting goals, analyzing the competitive landscape, and outlining steps to achieve success.";
    } else if (message.toLowerCase().includes('market research')) {
        response = "Market research is the process of gathering, analyzing, and interpreting information about a market, including its size, trends, competitors, and customer preferences. It helps businesses make informed decisions.";
    } else if (message.toLowerCase().includes('suggestions to improve my sales')) {
        response = "To improve your sales, consider the following suggestions:\n1. Identify and target your ideal customers.\n2. Analyze your competitors and differentiate your products or services.\n3. Implement effective marketing strategies to reach your target audience.\n4. Provide excellent customer service to build customer loyalty.\n5. Offer promotions or discounts to incentivize purchases.";
    }else if (message.toLowerCase().includes('Thank you')) {
        response = "Your Welcome i am here to help ";
    }else if (message.toLowerCase().includes('email us')) {
        // Ask for the user's email
        response = "Sure! Please enter your email address:";
        promptForEmail = true;
    } else if (promptForEmail) {
        // Save the user's email and ask for the message
        userEmail = message;
        response = "Great! Please enter your message:";
        promptForMessage = true;
        promptForEmail = false;
    } else if (promptForMessage) {
        // Save the user's message and send the email
        userMessage = message;
        sendEmail(userEmail, userMessage);
        response = "Your message has been sent. Thank you!";
        promptForMessage = false;
    } else {
        response = "I'm sorry, I didn't understand that. Can you please rephrase?";
    }

    // Display the response
    setTimeout(() => {
        displayMessage('bot', response);
    }, 1000);
    }

    function sendEmail(email, message) {
    // Simulate sending email (replace with actual email sending logic)
    const emailBody = `Email: ${email}\nMessage: ${message}`;
    alert(`Email sent to: alaaharmoush6122003@outlook.com\n\n${emailBody}`);
    }


</script>
</body>
</html>
