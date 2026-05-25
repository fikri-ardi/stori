<?php

namespace App\Services;

use App\Models\Visitor;

class VisitorTracker
{
    public function track($model): void
    {
        $exists = Visitor::query()
            ->whereMorphedTo('visitable', $model)
            ->where(function ($query) {

                if (auth()->check()) {
                    $query->where('user_id', auth()->id());
                } else {
                    $query->where(
                        'session_id',
                        session()->getId()
                    );
                }
            })
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if (! $exists) {
            $model->visitors()->create([
                'user_id' => auth()->id(),
                'session_id' => session()->getId(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'referer' => request()->headers->get('referer'),
                'data' => [
                    'language' => request()->getPreferredLanguage(),
                    'url' => request()->fullUrl(),
                ]
            ]);
        }
    }
}
