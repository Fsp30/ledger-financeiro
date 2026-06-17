
<?php

    namespace App\Domain\ValueObjects;


    abstract class DomainError extends Exception
    {
        public function __construct(
            string $message,
            public readonly int $statusCode,
        ) {
            parent::__construct($message);
        }
    }

    class AccountNotFoundError extends DomainError
    {
        public function __construct(string $accountId)
        {
            parent::__construct(
                "Account not found: {$accountId}",
                404,
            );
        }
    }

    class UnbalancedTransactionError extends DomainError{
        public function __construct()
        {
            parent::__construct(
                "Unbalanced transaction",
                422,
            );
        }
    }
?>