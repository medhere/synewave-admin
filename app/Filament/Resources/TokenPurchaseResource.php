<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokenPurchaseResource\Pages;
use App\Filament\Resources\TokenPurchaseResource\RelationManagers;
use App\Models\TokenList;
use App\Models\TokenPurchase;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TokenPurchaseResource extends Resource
{
    protected static ?string $model = TokenPurchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')->label('Artist')
                    ->options(User::where('role', 'artist')->pluck('name', 'id'))
                    ->searchable()
                    ->loadingMessage('Loading artists...')
                    ->searchPrompt('Search artists by their name')
                    ->optionsLimit(20)
                    ->required()
                    ->native(false),
                Select::make('token_list_id')->label('Token')
                    ->options(TokenList::pluck('token_name', 'id'))
                    ->searchable()
                    ->required()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                // Tables\Columns\TextColumn::make('token_owner.name')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('token_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('token_price')
                ->money('N')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('credits')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('token_to_expire')
                    ->searchable(),
                Tables\Columns\TextColumn::make('token_purchase_on')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('token_purchase_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListTokenPurchases::route('/'),
            'create' => Pages\CreateTokenPurchase::route('/create'),
            'view' => Pages\ViewTokenPurchase::route('/{record}'),
            'edit' => Pages\EditTokenPurchase::route('/{record}/edit'),
        ];
    }
}
