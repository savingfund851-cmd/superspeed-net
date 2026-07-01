<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'People';

    public static function canViewAny(): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('manage_users');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        // If not a superadmin, they can only see and manage customers
        if (!auth()->user()->isSuperAdmin()) {
            $query->where('role', 'customer');
        }
        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                        Forms\Components\TextInput::make('phone')
                            ->tel(),
                        Forms\Components\Textarea::make('address')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Role & Permissions')
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->options(function () {
                                if (auth()->user()->isSuperAdmin()) {
                                    return [
                                        'superadmin' => 'Super Admin',
                                        'admin'      => 'Admin',
                                        'customer'   => 'Customer',
                                    ];
                                }
                                return ['customer' => 'Customer'];
                            })
                            ->required()
                            ->default('customer')
                            ->live(), // Required to conditionally show permissions

                        Forms\Components\CheckboxList::make('permissions')
                            ->options([
                                'manage_users'         => 'Manage Users (Customers)',
                                'manage_packages'      => 'Manage Packages',
                                'manage_banners'       => 'Manage Banners',
                                'manage_tickets'       => 'Manage Tickets',
                                'manage_subscriptions' => 'Manage Subscriptions',
                                'manage_payments'      => 'Manage Payments',
                                'manage_requests'      => 'Manage Connection Requests',
                                'manage_settings'      => 'Manage Site Settings',
                                'manage_menus'         => 'Manage Menus',
                                'manage_pages'         => 'Manage Pages',
                            ])
                            ->columns(2)
                            ->visible(fn (\Filament\Forms\Get $get) => $get('role') === 'admin' && auth()->user()->isSuperAdmin())
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('role')
                    ->colors([
                        'danger' => 'superadmin',
                        'warning' => 'admin',
                        'success' => 'customer',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
