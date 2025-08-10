<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "من فضلك املأ البيانات بشكل صحيح.";
        exit;
    }

    // ← حط هنا الإيميل اللي حابب توصلك عليه الرسائل
    $recipient = "mazenelmgrbel@gmail.com"; 

    $subject = "رسالة جديدة من الموقع";
    $email_content = "الاسم: $name\n";
    $email_content .= "الإيميل: $email\n\n";
    $email_content .= "الرسالة:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "تم إرسال الرسالة!";
    } else {
        http_response_code(500);
        echo "فيه مشكلة، حاول تاني.";
    }
} else {
    http_response_code(403);
    echo "طلب غير مسموح.";
}
?>
