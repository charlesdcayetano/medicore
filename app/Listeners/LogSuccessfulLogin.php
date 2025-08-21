<?php
namespace App\Listeners;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event): void
    {
        // Store the user ID before login operations
        $userId = $event->user->id;
        
        activity('auth')
            ->causedBy($userId)
            ->withProperties([
                'ip'    => $this->request->ip(),
                'agent' => $this->request->userAgent(),
            ])
            ->log('User logged in');
    }
}