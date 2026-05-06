<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // El método boot() se ejecuta automáticamente cuando Laravel arranca.
        // Es el lugar estándar para registrar personalizaciones del framework.

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            /**
             * toMailUsing() reemplaza el correo de verificación por defecto de Laravel
             * con uno personalizado. Recibe un callback con dos parámetros:
             *      $notifiable : el usuario que debe verificar su email (instancia de User)
             *      $url        : la URL firmada y temporal que Laravel generó para verificar
             */

            return(new MailMessage)
                // MailMessage es el objeto que construye el correo. Cada método encadenado agrega una parte al mensaje.

                ->subject('Verificar Cuenta')
                // Define el asunto del correo. Aquí es donde personalizas el subject en español, en lugar del "Verify Email Address" que trae Laravel por defecto.

                ->line('Tu cuenta ya esta casi lista, solo debes presionar el enlace a continuacion')
                ->action('Confirmar Cuenta', $url)
                ->line('Si no creaste esta cuenta, puedes ignorar este mensaje.');
        });
    }
}
