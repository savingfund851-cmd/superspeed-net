<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;
    protected static ?string $navigationIcon = 'heroicon-o-signal';
    protected static ?string $navigationGroup = 'Internet Packages';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->user()->hasPermission('manage_packages');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Package Details')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('speed_mbps')
                        ->label('Speed (Mbps)')
                        ->numeric()
                        ->suffix('Mbps')
                        ->required(),
                    Forms\Components\TextInput::make('price')
                        ->label('Price (BDT)')
                        ->numeric()
                        ->prefix('৳')
                        ->required(),
                    Forms\Components\TextInput::make('validity_days')
                        ->label('Validity (Days)')
                        ->numeric()
                        ->default(30)
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                    Forms\Components\Textarea::make('description')
                        ->columnSpanFull()
                        ->rows(2),
                ])->columns(2),

            Forms\Components\Section::make('🏛️ BTRC Compliance')
                ->description('Required for regulatory compliance. Tariff must not exceed BTRC approved ceiling.')
                ->schema([
                    Forms\Components\TextInput::make('btrc_approved_tariff')
                        ->label('BTRC Approved Tariff Ceiling (BDT)')
                        ->numeric()
                        ->prefix('৳')
                        ->nullable(),
                    Forms\Components\TextInput::make('btrc_approval_number')
                        ->label('BTRC Approval/Reference Number')
                        ->maxLength(100)
                        ->nullable()
                        ->placeholder('e.g. BTRC/LL/ISP/2024/001'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('speed_mbps')
                    ->label('Speed')
                    ->formatStateUsing(fn ($state) => $state >= 1000 ? ($state / 1000) . ' Gbps' : $state . ' Mbps')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price (BDT)')
                    ->money('BDT')
                    ->sortable(),
                Tables\Columns\TextColumn::make('validity_days')->label('Validity')->suffix(' days'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
                Tables\Columns\TextColumn::make('btrc_approval_number')
                    ->label('BTRC Ref.')
                    ->placeholder('—')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Active Packages'),
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
            'index'  => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit'   => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
