<?php
session_start();
if (!isset($_SESSION['current_screen'])) {
    $_SESSION['current_screen'] = 'start';
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طبيب معك - تطبيق الرعاية الصحية</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php include 'header.php'; ?>
        
        <div class="content">
            <?php
            // تحديد الشاشة الحالية بناءً على الجلسة أو المعلمة
            $screen = isset($_GET['screen']) ? $_GET['screen'] : $_SESSION['current_screen'];
            $_SESSION['current_screen'] = $screen;
            
            switch($screen) {
                case 'start':
                    include 'start.php';
                    break;
                case 'home':
                    include 'home.php';
                    break;
                case 'diagnosis':
                    include 'diagnosis.php';
                    break;
                case 'specialty':
                    include 'specialty.php';
                    break;
                case 'search':
                    include 'search.php';
                    break;
                case 'booking':
                    include 'booking.php';
                    break;
                default:
                    include 'start.php';
            }
            ?>
        </div>
        
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>