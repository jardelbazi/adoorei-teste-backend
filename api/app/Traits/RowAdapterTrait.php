<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait RowAdapterTrait
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = parent::toArray();
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt();
        $array['deleted_at'] = $this->getDeletedAt();
        return $array;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return Carbon::parse($this->model->created_at)->toDateTimeString();
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return Carbon::parse($this->model->updated_at)->toDateTimeString();
    }

    /**
     * @return null|string
     */
    public function getDeletedAt(): ?string
    {
        return filled($this->model->deleted_at) ? Carbon::parse($this->model->deleted_at)->toDateTimeString() : null;
    }

    /**
     * @param Model $user
     * @return self
     */
    public static function of(Model $model): self
    {
        return new self($model);
    }

    /**
     * @param Collection $data
     * @return array
     */
    public static function collection(Collection $data): array
    {
        return collect($data)
            ->mapInto(self::class)
            ->all();
    }
}
