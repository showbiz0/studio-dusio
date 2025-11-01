<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    switch ($action) {
        case 'approve_review':
            if (isset($_POST['review_id'])) {
                $id = (int)$_POST['review_id'];
                $stmt = $pdo->prepare('UPDATE reviews SET approved = 1 WHERE id = ?');
                $stmt->execute([$id]);
                header('Location: admin.php');
                exit;
            }
            break;
        case 'delete_review':
            if (isset($_POST['review_id'])) {
                $id = (int)$_POST['review_id'];
                $stmt = $pdo->prepare('DELETE FROM reviews WHERE id = ?');
                $stmt->execute([$id]);
                header('Location: admin.php');
                exit;
            }
            break;
        case 'create_alert':
            if (isset($_POST['title']) && isset($_POST['text'])) {
                $title = trim($_POST['title']);
                $text = trim($_POST['text']);
                $set_featured = isset($_POST['set_featured']) ? 1 : 0;
                $set_popup = isset($_POST['set_popup']) ? 1 : 0;
                $popup_until = isset($_POST['set_popup']) ? $_POST['popup_until'] : null;
                
                if (!empty($title) && !empty($text)) {
                    // If this alert is to be featured, unfeature all other alerts first
                    if ($set_featured) {
                        $stmt = $pdo->prepare('UPDATE alerts SET featured = 0');
                        $stmt->execute();
                    }

                    // If this alert is to be a popup, disable popup on other alerts
                    if ($set_popup) {
                        $stmt = $pdo->prepare('UPDATE alerts SET popup = 0, popup_until = NULL');
                        $stmt->execute();
                    }

                    $stmt = $pdo->prepare('INSERT INTO alerts (date, title, text, featured, popup, popup_until) VALUES (NOW(), ?, ?, ?, ?, ?)');
                    $stmt->execute([$title, $text, $set_featured, $set_popup, $popup_until]);
                    header('Location: admin.php');
                    exit;
                }
            }
            break;
        case 'delete_alert':
            if (isset($_POST['alert_id'])) {
                $id = (int)$_POST['alert_id'];
                $stmt = $pdo->prepare('DELETE FROM alerts WHERE id = ?');
                $stmt->execute([$id]);
                header('Location: admin.php');
                exit;
            }
            break;
        case 'set_as_featured':
            if (isset($_POST['alert_id'])) {
                $id = (int)$_POST['alert_id'];
                
                // First, unfeature all alerts
                $stmt = $pdo->prepare('UPDATE alerts SET featured = 0');
                $stmt->execute();
                
                // Then, set the selected alert as featured
                $stmt = $pdo->prepare('UPDATE alerts SET featured = 1 WHERE id = ?');
                $stmt->execute([$id]);
                
                header('Location: admin.php');
                exit;
            }
            break;
    }
}

// Redirect back to admin page if no action was taken
header('Location: admin.php');
exit;
?>
