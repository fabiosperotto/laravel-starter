<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (DeleteAction $action, $record) {
                    if(Auth::user()->id == $record->id){
                        Notification::make()
                        ->danger()
                        ->title('Failed to delete!')
                        ->body('Você não pode se excluir da plataforma!')
                        ->persistent()
                        ->send();    
                        //finaliza o hook e cancela a acao de delete:
                        $action->cancel();
                    }                   
                })
        ];
    }
}
