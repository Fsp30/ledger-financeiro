<?php 
namespace App\Domain;


use Exception;

abstract class DomainError extends Exception
{
    public function __construct(
        string $message,
        public readonly int $statusCode,
    ) {
        parent::__construct($message);
    }
}

final class AccountNotFoundError extends DomainError
{
    public function __construct(string $accountId)
    {
        parent::__construct("Account not found: {$accountId}", 404);
    }
}

final class UnbalancedTransactionError extends DomainError
{
    public function __construct()
    {
        parent::__construct("Unbalanced transaction", 422);
    }
}

final class TransactionNotFoundError extends DomainError
{
    public function __construct(string $transactionId)
    {
        parent::__construct("Transaction not found: {$transactionId}", 404);
    }
}

final class ValidationError extends DomainError
{
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}

final class EmptyTransactionError extends DomainError
{
    public function __construct()
    {
        parent::__construct("Transaction must have at least one entry", 400);
    }
}

final class DuplicateTransactionError extends DomainError
{
    public function __construct(string $originalTransactionId)
    {
        parent::__construct(
            "Duplicate transaction detected. Original transaction ID: {$originalTransactionId}. This operation was already processed within the last 10 minutes.",
            409,
        );
    }
}
?>
