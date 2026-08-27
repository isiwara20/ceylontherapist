<?php
declare(strict_types=1);

/**
 * Flash Notification Message Helpers
 */

/**
 * Set a session flash notification
 * 
 * @param string $type ('success', 'error', 'warning', 'info')
 * @param string $message
 * @return void
 */
function setFlash(string $type, string $message): void
{
    $_SESSION['_flash'][$type][] = $message;
}

/**
 * Check if flash messages exist for type
 * 
 * @param string $type
 * @return bool
 */
function hasFlash(string $type): bool
{
    return !empty($_SESSION['_flash'][$type]);
}

/**
 * Retrieve and clear flash messages for type
 * 
 * @param string $type
 * @return array
 */
function getFlash(string $type): array
{
    if (isset($_SESSION['_flash'][$type])) {
        $messages = $_SESSION['_flash'][$type];
        unset($_SESSION['_flash'][$type]);
        return $messages;
    }
    return [];
}
