<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['value'] * $item['quantity'];
        }

        $data['total'] = $total;

        return $data;
    }
}
