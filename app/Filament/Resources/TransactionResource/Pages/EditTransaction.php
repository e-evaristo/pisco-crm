<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['value'] * $item['quantity'];
        }

        $data['total'] = $total;

        return $data;
    }
}
