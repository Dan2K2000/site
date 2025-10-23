<?php
/**
 * Functions for WildFocus website
 * Created by Danil Zaicev
 */

// Функция для вывода текущей даты и времени
function displayCurrentDateTime() {
    date_default_timezone_set('Europe/Moscow');
    $currentDateTime = date('d.m.Y H:i:s');
    echo "<div style='text-align: center; margin-top: 20px; color: #666;'>";
    echo "Текущая дата и время: " . $currentDateTime;
    echo "</div>";
}

// Функция для логирования посещений
function logVisit($page) {
    $logFile = 'visits.log';
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('Y-m-d H:i:s');
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    
    $logEntry = "[$date] IP: $ip | Page: $page | Browser: $userAgent" . PHP_EOL;
    
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Функция для получения информации о сервере
function getServerInfo() {
    return [
        'server_software' => $_SERVER['SERVER_SOFTWARE'],
        'php_version' => PHP_VERSION,
        'server_name' => $_SERVER['SERVER_NAME'],
        'document_root' => $_SERVER['DOCUMENT_ROOT']
    ];
}

// Функция для безопасного вывода текста
function safeEcho($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Автоматически логируем посещение страницы
if (!defined('NO_LOG')) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    logVisit($currentPage);
}
?>