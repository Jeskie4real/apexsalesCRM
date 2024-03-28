<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Task;
use Filament\Resources\Components\Tab;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        if (!auth()->user()->isAdmin()) {
            $tabs[] = Tab::make('My Tasks')
                ->badge(Task::where('user_id', auth()->id())->count())
                ->modifyQueryUsing(function ($query) {
                    return $query->where('user_id', auth()->id());
                });
        }

        $tabs[] = Tab::make('All Tasks')
            ->badge(Task::count());

        $tabs[] = Tab::make('Completed Tasks')
            ->badge(Task::where('completed', true)->count())
            ->modifyQueryUsing(function ($query) {
                return $query->where('completed', true);
            });

        $tabs[] = Tab::make('Incomplete Tasks')
            ->badge(Task::where('completed', false)->count())
            ->modifyQueryUsing(function ($query) {
                return $query->where('completed', false);
            });

        return $tabs;
    }
}
