<?php

namespace App\Filament\Resources\NewsletterSubscriber\Pages;

use App\Filament\Resources\NewsletterSubscriber\NewsletterSubscriberResource;
use Filament\Resources\Pages\ListRecords;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;
}
