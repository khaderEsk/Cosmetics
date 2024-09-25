<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    use GeneralTrait;

    public function handle(Request $request, Closure $next, $role)
    {
        try {
            // تحقق مما إذا كان المستخدم مسجل الدخول
            if (!Auth::check()) {
                return $this->returnError('401', 'You must be logged in to access this resource');
            }

            // الحصول على المستخدم الحالي
            $user = Auth::user();

            // معالجة الأدوار في حالة ما إذا كانت كـ string أو array
            $roles = is_array($role) ? $role : explode('|', $role);

            // التحقق مما إذا كان لدى المستخدم أي دور من الأدوار المحددة
            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    return $next($request); // السماح بالوصول إذا كان لديه الدور المطلوب
                }
            }

        } catch (\Exception $e) {
            return $this->returnError('512', "An error occurred: " . $e->getMessage());
        }

        // في حال عدم امتلاك المستخدم للدور المطلوب
        return $this->returnError('403', "You don't have the right role");
    }
}
