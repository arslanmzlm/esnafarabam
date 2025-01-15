<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'abilities' => $request->user()?->getAbilities(),
            ],
            'toasts' => $this->getToasts($request),
        ];
    }

    private function getToasts(Request $request): array
    {
        $toast = [];

        if ($messages = $request->session()->get('toast.success')) {
            if (is_array($messages)) {
                foreach ($messages as $item) {
                    $toast[] = [
                        'type' => 'success',
                        'message' => $item,
                    ];
                }
            } else {
                $toast[] = [
                    'type' => 'success',
                    'message' => $messages,
                ];
            }
        }

        if ($messages = $request->session()->get('toast.error')) {
            if (is_array($messages)) {
                foreach ($messages as $item) {
                    $toast[] = [
                        'type' => 'error',
                        'message' => $item,
                    ];
                }
            } else {
                $toast[] = [
                    'type' => 'error',
                    'message' => $messages,
                ];
            }
        }

        if ($messages = $request->session()->get('toast.warning')) {
            if (is_array($messages)) {
                foreach ($messages as $item) {
                    $toast[] = [
                        'type' => 'warning',
                        'message' => $item,
                    ];
                }
            } else {
                $toast[] = [
                    'type' => 'warning',
                    'message' => $messages,
                ];
            }
        }

        if ($messages = $request->session()->get('toast.info')) {
            if (is_array($messages)) {
                foreach ($messages as $item) {
                    $toast[] = [
                        'type' => 'info',
                        'message' => $item,
                    ];
                }
            } else {
                $toast[] = [
                    'type' => 'info',
                    'message' => $messages,
                ];
            }
        }

        return $toast;
    }
}
