<?php

namespace App\Console;

use Log;
use App\Models\User;
use App\Models\LettersIn;
use App\Models\Imputation;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CourrierNonReponduNotification;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {

            // Exécute la requête pour récupérer les courriers et les données supplémentaires via les jointures
            $lettersData = Imputation::join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                        ->join('directions', 'directions.id', '=', 'imputations.direction_id')
                        //->join('users', 'users.id', '=', 'letters_ins.user_id'), 'users.id as user_id' // Joindre la table des utilisateurs
                        ->select('letters_ins.*', 'imputations.date_reception', 'directions.sigle')
                        ->where('letters_ins.code_instruction', 'repondre')
                        ->where('imputations.date_reception', '<=', now()->subHours(48))
                        ->get();


            // Récupérer la liste des utilisateurs qui doivent recevoir la notif
            $adminis = User::whereIn('role_id', [1])->get();


            // Envoi de la notification
            foreach ($lettersData as $courrier) {

                foreach ($adminis as $admin) {
                    // Vérifiez si une notification existe déjà pour ce courrier et cet administrateur
                    $notificationExists = DB::table('notifications')
                        ->where('notifiable_id', $admin->id)
                        ->where('notifiable_type', User::class)
                        ->where('data', 'like', '%"letter_id":' . $courrier->id . '%')
                        ->exists();

                    if (!$notificationExists) {
                        // Si la notification n'existe pas, alors l'envoyer
                        $admin->notify(new CourrierNonReponduNotification($courrier));
                    }
                }

            }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
