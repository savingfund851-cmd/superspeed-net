<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Billing';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->user()->hasPermission('manage_subscriptions');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Subscription Details')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('package_id')
                        ->relationship('package', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\DatePicker::make('start_date')->required(),
                    Forms\Components\DatePicker::make('end_date')->required(),
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending'   => 'Pending',
                            'active'    => 'Active',
                            'expired'   => 'Expired',
                            'suspended' => 'Suspended',
                            'cancelled' => 'Cancelled',
                        ])
                        ->required(),
                ])->columns(2),

            Forms\Components\Section::make('🎯 Special Discount Override')
                ->description('Leave custom price empty to use the standard package price.')
                ->schema([
                    Forms\Components\TextInput::make('custom_price')
                        ->label('Custom Price (BDT)')
                        ->numeric()
                        ->prefix('৳')
                        ->nullable()
                        ->helperText('Override the standard package price for this customer (corporate/personal discount).'),
                    Forms\Components\Textarea::make('discount_reason')
                        ->label('Discount Reason / Admin Notes')
                        ->nullable()
                        ->columnSpanFull()
                        ->rows(3)
                        ->helperText('Document why a custom price was applied.'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.name')
                    ->label('Package')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('end_date')->date()->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success'  => 'active',
                        'danger'   => 'suspended',
                        'warning'  => 'expired',
                        'gray'     => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('custom_price')
                    ->label('Custom Price')
                    ->money('BDT')
                    ->sortable()
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'active'    => 'Active',
                        'expired'   => 'Expired',
                        'suspended' => 'Suspended',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit'   => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
