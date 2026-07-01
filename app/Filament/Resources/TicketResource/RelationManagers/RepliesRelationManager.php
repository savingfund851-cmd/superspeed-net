<?php

namespace App\Filament\Resources\TicketResource\RelationManagers;

use App\Models\TicketReply;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class RepliesRelationManager extends RelationManager
{
    protected static string $relationship = 'replies';
    protected static ?string $title = '💬 Conversation';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('message')
                ->label('Message')
                ->required()
                ->rows(3)
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_admin')
                ->label('Admin Reply?')
                ->default(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('message')
            ->defaultSort('created_at', 'asc')
            ->columns([
                Tables\Columns\IconColumn::make('is_admin')
                    ->label('From')
                    ->icon(fn ($state) => $state ? 'heroicon-o-shield-check' : 'heroicon-o-user')
                    ->color(fn ($state) => $state ? 'success' : 'primary')
                    ->tooltip(fn ($state) => $state ? 'Admin / Support Team' : 'Customer'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Sender')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(120)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Time')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->headerActions([
                // Admin reply from here
                Tables\Actions\Action::make('admin_reply')
                    ->label('📨 Admin Reply করুন')
                    ->color('success')
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->label('আপনার Reply')
                            ->required()
                            ->rows(4),
                        Forms\Components\Select::make('status')
                            ->label('Ticket Status আপডেট করুন')
                            ->options([
                                'open'        => 'Open',
                                'in_progress' => 'In Progress',
                                'resolved'    => 'Resolved',
                                'closed'      => 'Closed',
                            ])
                            ->default(fn () => $this->getOwnerRecord()->status),
                    ])
                    ->action(function (array $data): void {
                        $ticket = $this->getOwnerRecord();
                        TicketReply::create([
                            'ticket_id' => $ticket->id,
                            'user_id'   => auth()->id(),
                            'message'   => $data['message'],
                            'is_admin'  => true,
                        ]);
                        $ticket->update(['status' => $data['status']]);
                        Notification::make()->title('✅ Reply পাঠানো হয়েছে!')->success()->send();
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([])
            ->paginated(false);
    }
}
