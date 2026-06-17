
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
?>