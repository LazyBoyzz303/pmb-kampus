<?php
declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function old(string $key): string
{
    return e($_SESSION['old'][$key] ?? '');
}

function selected(string $key, string $value): string
{
    return (($_SESSION['old'][$key] ?? '') === $value) ? 'selected' : '';
}

function checked(string $key, string $value): string
{
    return (($_SESSION['old'][$key] ?? '') === $value) ? 'checked' : '';
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function redirect(string $location): never
{
    header('Location: ' . $location);
    exit;
}
