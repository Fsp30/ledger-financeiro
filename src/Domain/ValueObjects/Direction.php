    <?php

    namespace App\Domain\ValueObjects;

    enum  Direction: string
    {
        case Debit = 'Debit';
        case Credit = 'Credit';
    }

    ?>