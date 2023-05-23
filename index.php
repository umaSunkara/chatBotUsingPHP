<?php
// Your OpenAI API credentials
$apiKey = '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';

// The API endpoint
$url = 'https://api.openai.com/v1/chat/completions';

// Function to send a message and get a response from the chatbot
function sendMessage($message, $apiKey, $url) {
    // Define headers
    $headers = array(
        "Authorization: Bearer {$apiKey}",
        "Content-Type: application/json",
    );

    // Define data
    $data = array(
        "model" => "gpt-3.5-turbo",
        "messages" => $message,
        "max_tokens" => 500,
    );

    // Init cURL
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // Execute the request
    $result = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
        // Handle the error accordingly
    } else {
      $response = json_decode($result, true);

// Retrieve the assistant's message
$message = $response['choices'][0]['message']['content'];
        echo $message;
    }

    // Close cURL
    curl_close($curl);
}

// Handle user input


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <style>
      footer 
      {
        
        position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
      }
    </style>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet/css" href="style.css">

</head>
<body>
<nav class="navbar text-center text-light bg-info my-0">
  <h3>Chat Bot </h3>
</nav>
<div class="form-group text-center">
        <form method="POST" class="text-center">
          <pre>
            Chat Bot: I am ChatGPT. How can I assist you today?
          </pre>
          <label for="message">Input Message</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" name="message" placeholder="Enter your message" autocomplete="off">
            <br>
            <button type="submit" class="btn btn-info">Send</button><br> <br>
            <label for="Response">Chat Bot : <br></label>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = $_POST['message'];

    // Define messages
    $messages = array(
        array(
            "role" => "system",
            "content" => "You are a helpful assistant."
        ),
        array(
            "role" => "user",
            "content" => $userMessage
        )
    );

    // Send the messages to the chatbot
    sendMessage($messages, $apiKey, $url);
} ?>
        </form>
    </div>
    <footer class="bg-info text-center"><h3>&reg; All Rights Reserved.. @Chat Bot </h3></footer>
</body>
</html>
