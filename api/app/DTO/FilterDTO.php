<?php

namespace App\DTO;

abstract class FilterDTO
{
    public function __construct(
        protected ?int $id = null,
        protected ?bool $deleted = null,
    ) {
    }

    /**
     * @return null|int
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|bool
     */
    public function deleted(): ?bool
    {
        return $this->deleted;
    }
}
