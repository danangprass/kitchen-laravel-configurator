<?php

namespace App\Filament\Resources\NewsletterSubscriber;

use App\Filament\Resources\NewsletterSubscriber\Pages\ListNewsletterSubscribers;
use App\Filament\Resources\NewsletterSubscriber\Pages\ViewNewsletterSubscriber;
use App\Models\NewsletterSubscriber;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $navigationLabel = 'Newsletter Subscribers';

    public static function getNavigationGroup(): ?string
    {
        return 'Marketing';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Subscribed at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->headerActions([
                Action::make('exportCsv')
                    ->label('Export CSV')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->action(function () {
                        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->get();

                        $csv = fopen('php://temp', 'r+');
                        fputcsv($csv, ['Email', 'Subscribed At']);

                        foreach ($subscribers as $subscriber) {
                            fputcsv($csv, [
                                $subscriber->email,
                                $subscriber->created_at->toDateTimeString(),
                            ]);
                        }

                        rewind($csv);
                        $content = stream_get_contents($csv);
                        fclose($csv);

                        return response()->streamDownload(
                            fn () => print ($content),
                            'newsletter_subscribers_'.now()->format('Ymd_His').'.csv',
                            ['Content-Type' => 'text/csv'],
                        );
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNewsletterSubscribers::route('/'),
            'view' => ViewNewsletterSubscriber::route('/{record}'),
        ];
    }
}
