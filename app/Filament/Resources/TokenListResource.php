<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokenListResource\Pages;
use App\Filament\Resources\TokenListResource\RelationManagers;
use App\Models\TokenList;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TokenListResource extends Resource
{
    protected static ?string $model = TokenList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('token_name')->required()->autocapitalize('words'),
                Textarea::make('token_desc')->label('Description')->autosize(),
                TextInput::make('token_price')->numeric()->default(1000)->prefix('N')->required(),
                // TextInput::make('token_expiry'),
                TextInput::make('credits')->numeric()->default(0)->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('token_name'),
                // TextColumn::make('token_desc'),
                TextColumn::make('token_price'),
                // TextColumn::make('token_expiry'),
                TextColumn::make('credits'),
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
            'index' => Pages\ListTokenLists::route('/'),
            'create' => Pages\CreateTokenList::route('/create'),
            // 'view' => Pages\ViewTokenList::route('/{record}'),
            'edit' => Pages\EditTokenList::route('/{record}/edit'),
        ];
    }    
}
