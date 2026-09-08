<?php
declare(strict_types=1);

/**
 * Validation Helper Functions
 */

/**
 * Validate required field
 * 
 * @param mixed $value
 * @return bool
 */
function validateRequired(mixed $value): bool
{
    if (is_null($value)) {
        return false;
    }
    if (is_string($value) && trim($value) === '') {
        return false;
    }
    if (is_array($value) && empty($value)) {
        return false;
    }
    return true;
}

/**
 * Validate email address format
 * 
 * @param string $email
 * @return bool
 */
function validateEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number format (basic format check for LK / intl numbers)
 * 
 * @param string $phone
 * @return bool
 */
function validatePhone(string $phone): bool
{
    $clean = preg_replace('/[^\d+]/', '', $phone);
    return strlen($clean) >= 9 && strlen($clean) <= 15;
}
