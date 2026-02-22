<?php
// Enable CORS (Remove this in production)
// header("Access-Control-Allow-Origin: http://localhost:4321");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");

header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['what'])) {
    require_once 'db.php';

    switch ($_GET['what']) {
        case 'reviews':
            // Return only approved reviews
            $stmt = $pdo->prepare('SELECT id, date, name, surname, text FROM reviews WHERE approved = true ORDER BY date DESC');
            $stmt->execute();
            $reviews = $stmt->fetchAll();
            if (count($reviews) > 0) {
                echo json_encode($reviews);
            } else {
                echo json_encode(null);
            }
            break;
        case 'alerts':
            // Return all alerts
            $stmt = $pdo->prepare('SELECT id, date, title, text FROM alerts ORDER BY date DESC');
            $stmt->execute();
            $notices = $stmt->fetchAll();
            if (count($notices) > 0) {
                echo json_encode($notices);
            } else {
                echo json_encode(null);
            }
            break;
        case 'featured-alert':
            // Return only the featured alert
            $stmt = $pdo->prepare('SELECT id, date, title, text FROM alerts WHERE featured = true');
            $stmt->execute();
            $notice = $stmt->fetchAll();
            if (count($notice) > 0) {
                echo json_encode($notice[0]);
            } else {
                echo json_encode(null);
            }
            break;
        case 'popup-alert':
            // Return only the popup alert if within the valid date
            $stmt = $pdo->prepare('SELECT id, date, title, text, popup_until FROM alerts WHERE popup = true ORDER BY date DESC LIMIT 1');
            $stmt->execute();
            $notice = $stmt->fetchAll();
            if (count($notice) > 0) {
                $current_date = new DateTime();
                $popup_until = new DateTime($notice[0]['popup_until']);
                if ($current_date <= $popup_until) {
                    echo json_encode($notice[0]);
                } else {
                    // Popup period has expired
                    echo json_encode(null);
                }
            } else {
                // No popup alert found
                echo json_encode(null);
            }
    }
}
?>
