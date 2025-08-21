<?php
namespace App\Listeners;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class LogLogout
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Logout $event): void
    {
        // Store the user ID before logout occurs
        $userId = auth()->id();
        
        // Perform logout
        auth()->logout();
        
        // Log the activity with the stored user ID
        activity('auth')
            ->causedBy($userId)
            ->withProperties([
                'ip' => $this->request->ip(),
                'agent' => $this->request->userAgent(),
            ])
            ->log('User logged out');
    }
}