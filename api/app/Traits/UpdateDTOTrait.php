<?php

namespace App\Traits;

trait UpdateDTOTrait
{
    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $array = array_merge(['id' => $this->getId()], parent::toArray());
        return $array;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }
}
