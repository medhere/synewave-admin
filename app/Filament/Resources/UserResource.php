<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('unique_id'),
                Select::make('role')->native(false)->options([
                    'admin'=>'Admin',
                    'user'=>'User',
                    'artist'=>'Artist',
                ])->required(),
                TextInput::make('name')->required()->autocapitalize('words'),
                TextInput::make('nickname')->required()
                ->unique()
                // ->afterStateUpdated(function (?string $state, ?string $old, Set $set) {
                //     $user = User::where('nickname', $state)->first('nickname');
                //     if ($state == $user['nickname']) $set('errors.nickname', "Nickname $state is already in use.");
                //     else unset($state['errors']['nickname']);  
                // })
                // ->live(onBlur: true)
                ,
                TextInput::make('phone')->tel()->required(),
                TextInput::make('email')->email()->required(),
                DatePicker::make('dob')->label('Date of Birth')->native(false),
                TextInput::make('wallet')->numeric()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unique_id'),
                TextColumn::make('role'),
                TextColumn::make('name')->searchable(),
                // TextColumn::make('nickname')->sortable()->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('email')->searchable(),
                // TextColumn::make('dob'),
                TextColumn::make('wallet')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
