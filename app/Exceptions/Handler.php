<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // エラーページ表示処理
    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|RedirectResponse|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        if (
            // config/app.phpでdebugがtrueだったらErrorページを表示(本番リリース時に修正すること)
            config('app.debug')
            && in_array($response->getStatusCode(), [500, 503, 404, 403], true)
        ) {
            return Inertia::render('Error', [
                'status' => $response->getStatusCode()
            ])->toResponse($request)->setStatusCode($response->getStatusCode());
        } elseif ($response->getStatusCode() === 419) {
            return back()->with([
                'message' => __('The page expired, please try again.'),
            ]);
        }

        return $response;
    }
}