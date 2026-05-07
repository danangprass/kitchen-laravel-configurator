<?php

namespace App\Filament\Resources\NewsletterSubscriber\Pages;

use App\Filament\Resources\NewsletterSubscriber\NewsletterSubscriberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewNewsletterSubscriber extends ViewRecord
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
