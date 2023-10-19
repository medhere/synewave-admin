<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokenPurchaseResource\Pages;
use App\Filament\Resources\TokenPurchaseResource\RelationManagers;
use App\Models\TokenPurchase;
use Filament\Forms;
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
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('toekn_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('token_price')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('credits')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('token_to_expie')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('token_purchase_on')
                    ->required(),
                Forms\Components\TextInput::make('token_purchase_by')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('toekn_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('token_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('credits')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('token_to_expie')
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
