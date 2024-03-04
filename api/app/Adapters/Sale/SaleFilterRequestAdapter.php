<?php

namespace App\Adapters\Sale;

use App\DTO\Sale\SaleFilterDTO;
use Illuminate\Http\Request;

class SaleFilterRequestAdapter extends SaleFilterDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
            deleted: $this->request->query('deleted'),
        );
    }
}
