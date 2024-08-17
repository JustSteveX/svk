<?php

namespace App\Http\Middleware;

use App\Models\Invitation;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HasInvitation
{
    public function handle($request, Closure $next)
    {
        /**
         * Only for GET requests. Otherwise, this middleware will block our registration.
         */
        if ($request->isMethod('get')) {

            /**
             * No token = Goodbye.
             */
            if (! $request->has('invitation_token')) {
                return abort(404, 'Not found.');
            }

            $invitation_token = $request->get('invitation_token');

            /**
             * Lets try to find invitation by its token.
             * If failed -> return to request page with error.
             */
            try {
                $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return abort(404, 'Not found.');
            }

            /**
             * Let's check if users already registered.
             * If yes -> redirect to login with error.
             */
            if (! is_null($invitation->registered_at)) {
                return redirect(route('login'))->with('error', 'Der Einladungslink wurde bereits verwendet.');
            }
        }

        return $next($request);
    }
}
