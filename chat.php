<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<style>
/* General container positioning */
#chat-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000; /* Ensures chat appears on top */
}

/* Floating circular button */
#chat-btn {
    background-color: #ffc107;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 30px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect on the chat button */
#chat-btn:hover {
    transform: scale(1.1); /* Slightly grow the button */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* Initially hidden chat box */
#chat-box {
    display: none;
    width: 350px;
    max-height: 500px;
    background-color: #fff;
    border-radius: 12px;
    padding: 10px;
    border: 1px solid #ddd;
    position: absolute;
    bottom: 80px; /* Position above the button */
    right: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: column;
}

/* Chat header with close button */
#chat-box-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
    font-size: 16px;
    position: relative;
}

/* Close button for chat box */
#close-chat-btn {
    background: none;
    border: none;
    font-size: 22px;
    color: #333;
    cursor: pointer;
    padding: 0;
    position: absolute;
    top: -2px;
    right: 10px;
}

/* Welcome message styling */
#welcome-message {
    font-size: 14px;
    color: #333;
    padding: 10px;
    background-color: #f1f1f1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center; /* Center the welcome message */
}

#welcome-image img {
    width: 50%; /* Adjust the size */
    border-radius: 50%; /* Makes the image round */
    background-color: gray; /* Light background color */
    padding: 5px; /* Space between the image and the border */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds a shadow for a more polished look */
    display: block;
    margin: 0 auto 10px auto; 
}

/* Styling for message timestamp */
.timestamp {
    font-size: 10px;
    color: white;
    margin-left: 5px;
    vertical-align: bottom;
}

/* Adjustments to ensure messages don't get cut off */
#message-container {
    flex-grow: 1;
    overflow-y: auto;
    padding-right: 10px;
    display: flex;
    flex-direction: column;
    padding-bottom: 10px;
}

/* Styling for individual messages */
#message-container .sent, 
#message-container .received {
    padding: 8px 12px;
    border-radius: 15px;
    margin-bottom: 10px;
    max-width: 80%;
    word-wrap: break-word;
    position: relative;
}

/* Sent message styles (aligned to the right) */
#message-container .sent {
    background-color: #ffc107;
    color: white;
    align-self: flex-end;
    border-radius: 15px 15px 0 15px; /* Rounded right side */
}

/* Received message styles (aligned to the left) */
#message-container .received {
    background-color: #f1f1f1;
    color: #333;
    align-self: flex-start;
    border-radius: 15px 15px 15px 0; /* Rounded left side */
}

/* Avatar in received message */
#message-container .received .avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    position: absolute;
    top: -8px;
    left: -35px;
}

/* Styling for the message input area */
#input-container {
    display: flex;
    align-items: center;
    width: 100%;
    border-top: 1px solid #ddd;
    padding-top: 10px;
}

/* Styling for the message input field */
#message-input {
    width: 80%;
    height: 40px;
    padding: 10px;
    border-radius: 20px;
    border: 1px solid #ddd;
    margin-right: 10px; /* Space between input and button */
    font-size: 14px;
    box-sizing: border-box;
    resize: none;
}

/* Styling for the send button */
#chat-box button {
    background-color: #ffc107;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect for the send button */
#chat-box button:hover {
    background-color: #dc3545;
}

/* Smooth transition for chat box visibility */
#chat-box {
    transition: all 0.3s ease-in-out;
}
</style>


<div id="chat-container">
    <button id="chat-btn" onclick="toggleChat()">💬</button>
    <div id="chat-box">
        <!-- Chat Header with Close Button -->
        <div id="chat-box-header">
            <span>Chat</span>
            <button id="close-chat-btn" onclick="toggleChat()">×</button>
        </div>

        
        <!-- Welcome Message (Centered) -->
        <div id="welcome-message">
            <div id="welcome-image">
                <img src="images/logo.png">
            </div>            
            Welcome to our chat system! Feel free to communicate with us.
        </div>

        <!-- Message Container -->
        <div id="message-container">
            <!-- Sample received message -->
            <div class="received">
                <img src="path-to-avatar.jpg" class="avatar" alt="Avatar">
                Hello, how can I help you?
            </div>
            <!-- Sample sent message -->
            <div class="sent">I'm just here to test the chat system!</div>
        </div>

        <!-- Input Container for Message Input and Send Button -->
        <div id="input-container">
            <textarea name="message" id="message-input" placeholder="Type your message..."></textarea>
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>

<script>
    // Function to toggle the visibility of the chat box
    function toggleChat() {
        const chatBox = document.getElementById("chat-box");
        const chatBtn = document.getElementById("chat-btn");

        // Toggle the visibility of the chat box
        if (chatBox.style.display === "none" || chatBox.style.display === "") {
            chatBox.style.display = "block"; // Show chat box
            chatBtn.style.transform = "rotate(45deg)"; // Rotate the button to indicate open state
        } else {
            chatBox.style.display = "none"; // Hide chat box
            chatBtn.style.transform = "rotate(0deg)"; // Reset rotation of the button
        }
    }

    // Function to close the chat box when the close button is clicked
    function closeChat() {
        const chatBox = document.getElementById("chat-box");
        const chatBtn = document.getElementById("chat-btn");

        chatBox.style.display = "none"; // Hide the chat box
        chatBtn.style.transform = "rotate(0deg)"; // Reset the rotation of the button
    }

    // Ensure the chat box is hidden by default on page load
    window.addEventListener('DOMContentLoaded', (event) => {
        const chatBox = document.getElementById("chat-box");
        chatBox.style.display = "none"; // Hide the chat box on initial page load
    });
</script>




</body>
</html>