<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjetoResource\Pages;
use App\Filament\Resources\ProjetoResource\RelationManagers;
use App\Models\Projeto;
use Filament\Forms;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjetoResource extends Resource
{
    protected static ?string $model = Projeto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nome')
                ->required()
                ->label('Nome do Projeto'),

            Textarea::make('descricao')
                ->label('Descrição')
                ->wrap(),

            Repeater::make('tarefas')
                ->relationship('tarefas')  // Nome da relação no modelo Projeto
                ->schema([
                    TextInput::make('titulo')
                        ->required()
                        ->label('Título da Tarefa'),

                    Textarea::make('descricao')
                        ->label('Descrição da Tarefa'),

                    Select::make('status')
                        ->options([
                            'Pendente' => 'Pendente',
                            'Concluída' => 'Concluída',
                            'Em Andamento' => 'Em Andamento',
                        ])
                        ->required()
                        ->label('Status da Tarefa'),

                    TextInput::make('data_entrega')
                        ->label('Data de Entrega')
                        ->type('date'),
                ])
                ->columns(2) // Quantas colunas o repetidor vai ocupar
                ->label('Tarefas') // Título do campo repetidor
                ->addActionLabel('Adicionar Nova Tarefa'), // Texto do botão de adicionar tarefa
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('nome')
                ->label('Nome do Projeto'),

            TextColumn::make('descricao')
                ->label('Descrição'),

            TextColumn::make('tarefas_count')
                ->counts('tarefas')
                ->label('Total de Tarefas'),

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
            'index' => Pages\ListProjetos::route('/'),
            'create' => Pages\CreateProjeto::route('/create'),
            'edit' => Pages\EditProjeto::route('/{record}/edit'),
        ];
    }
}
