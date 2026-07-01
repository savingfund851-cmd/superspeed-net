<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use App\Models\TicketReply;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Support';

    public static function canViewAny(): bool
    {
        return auth()->user()->hasPermission('manage_tickets');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Ticket Details')->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()->required()->label('Customer'),
                Forms\Components\TextInput::make('subject')->required()->columnSpanFull(),
                Forms\Components\Textarea::make('message')->required()->rows(4)->columnSpanFull(),
                Forms\Components\Select::make('priority')
                    ->options(['low'=>'Low','medium'=>'Medium','high'=>'High','urgent'=>'Urgent'])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options(['open'=>'Open','in_progress'=>'In Progress','resolved'=>'Resolved','closed'=>'Closed'])
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('📨 Admin Reply')->schema([
                Forms\Components\Textarea::make('admin_reply')
                    ->label('Reply to Customer (will be sent when you save)')
                    ->rows(4)->columnSpanFull()
                    ->dehydrated(false),
            ])->visible(fn ($record) => $record !== null),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Customer')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('subject')->searchable()->limit(40),
                Tables\Columns\BadgeColumn::make('priority')
                    ->colors(['success'=>'low','info'=>'medium','warning'=>'high','danger'=>'urgent']),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['primary'=>'open','warning'=>'in_progress','success'=>'resolved','secondary'=>'closed']),
                Tables\Columns\TextColumn::make('replies_count')->counts('replies')->label('Replies'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('Submitted'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['open'=>'Open','in_progress'=>'In Progress','resolved'=>'Resolved','closed'=>'Closed']),
                Tables\Filters\SelectFilter::make('priority')
                    ->options(['low'=>'Low','medium'=>'Medium','high'=>'High','urgent'=>'Urgent']),
            ])
            ->actions([
                Tables\Actions\Action::make('reply')
                    ->label('Reply')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('primary')
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->label('Admin Reply')
                            ->required()->rows(4),
                        Forms\Components\Select::make('status')
                            ->label('Update Status')
                            ->options(['open'=>'Open','in_progress'=>'In Progress','resolved'=>'Resolved','closed'=>'Closed'])
                            ->default(fn ($record) => $record->status),
                    ])
                    ->action(function (Ticket $record, array $data): void {
                        TicketReply::create([
                            'ticket_id' => $record->id,
                            'user_id'   => auth()->id(),
                            'message'   => $data['message'],
                            'is_admin'  => true,
                        ]);
                        $record->update(['status' => $data['status']]);
                        Notification::make()->title('Reply sent!')->success()->send();
                    }),
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
        return [
            \App\Filament\Resources\TicketResource\RelationManagers\RepliesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit'   => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
