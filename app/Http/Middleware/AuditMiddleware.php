<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Added this line to fix the error
use Illuminate\Support\Str;

class AuditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only log if user is authenticated
        if (Auth::check()) {
            $this->logActivity($request);
        }

        return $response;
    }

    /**
     * Log the user activity
     */
    private function logActivity(Request $request)
    {
        try {
            $action = $this->determineAction($request);
            
            if ($action) {
                AuditTrail::create([
                    'user_id' => Auth::id(),
                    'action' => $action,
                    'model_type' => $this->determineModelType($request),
                    'model_id' => $this->determineModelId($request),
                    'description' => $this->generateDescription($request, $action),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                ]);
            }
        } catch (\Exception $e) {
            // Log error but don't break the application
            Log::error('Audit logging failed: ' . $e->getMessage());
        }
    }

    /**
     * Determine the action being performed
     */
    private function determineAction(Request $request): ?string
    {
        $method = $request->method();
        $route = $request->route();

        if (!$route) {
            return null;
        }

        $action = $route->getActionMethod();

        // Map common actions
        if (in_array($action, ['index', 'show'])) {
            return 'view';
        } elseif ($action === 'store') {
            return 'create';
        } elseif ($action === 'update') {
            return 'update';
        } elseif ($action === 'destroy') {
            return 'delete';
        } elseif ($action === 'login') {
            return 'login';
        } elseif ($action === 'logout') {
            return 'logout';
        }

        return $action;
    }

    /**
     * Determine the model type from the route
     */
    private function determineModelType(Request $request): ?string
    {
        $route = $request->route();
        if (!$route) {
            return null;
        }

        $uri = $route->uri();
        
        // Extract model name from URI
        if (preg_match('/^(\w+)/', $uri, $matches)) {
            $modelName = ucfirst(Str::singular($matches[1]));
            return $modelName;
        }

        return null;
    }

    /**
     * Determine the model ID from the route parameters
     */
    private function determineModelId(Request $request): ?int
    {
        $route = $request->route();
        if (!$route) {
            return null;
        }

        $parameters = $route->parameters();
        
        // Look for common model ID parameters
        foreach ($parameters as $key => $value) {
            if (in_array($key, ['patient', 'appointment', 'medicine', 'billing', 'user', 'department', 'room'])) {
                return is_numeric($value) ? (int)$value : null;
            }
        }

        return null;
    }

    /**
     * Generate a human-readable description of the action
     */
    private function generateDescription(Request $request, string $action): string
    {
        $modelType = $this->determineModelType($request);
        $modelId = $this->determineModelId($request);
        
        $description = ucfirst($action);
        
        if ($modelType) {
            $description .= " {$modelType}";
            
            if ($modelId) {
                $description .= " (ID: {$modelId})";
            }
        }

        return $description;
    }
}
