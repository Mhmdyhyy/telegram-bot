<?php
$botToken = "6335492526:AAHi3dHkDGXKB4S9qQdNARshAz6U02R8M7c";
$webhookUrl = "https://your-domain.com/index.php";

// تعيين الويب هوك
$apiUrl = "https://api.telegram.org/bot$botToken/setWebhook?url=$webhookUrl";
file_get_contents($apiUrl);

// معالجة الطلبات الواردة
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (isset($update["message"])) {
    $message = $update["message"];
    $chatId = $message["chat"]["id"];
    $text = $message["text"];

    if ($text == "/start") {
        sendMessage($chatId, "مرحبًا! أنا بوت يعمل على GitHub.");
    }
}

function sendMessage($chatId, $text) {
    global $botToken;
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $postData = http_build_query([
        'chat_id' => $chatId,
        'text' => $text
    ]);
    file_get_contents("$url?$postData");
}
?>
