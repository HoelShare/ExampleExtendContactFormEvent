<?php declare(strict_types=1);

namespace ExampleExtendContactFormEvent\Custom;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class CustomEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $message;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
