<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

/**
 * @OA\Tag(
 *     name="User Management",
 *     description="User management endpoints for admin panel"
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get list of users (Admin)",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         @OA\Schema(type="integer", default=10, minimum=1, maximum=100)
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by name or email",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status",
     *         @OA\Schema(type="string", enum={"active", "inactive"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Users retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Users retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="last_page", type="integer", example=3),
     *                 @OA\Property(property="per_page", type="integer", example=10),
     *                 @OA\Property(property="total", type="integer", example=25),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="John Doe"),
     *                         @OA\Property(property="email", type="string", example="john@example.com"),
     *                         @OA\Property(property="role", type="string", example="admin"),
     *                         @OA\Property(property="status", type="string", example="active"),
     *                         @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true),
     *                         @OA\Property(property="created_at", type="string", format="date-time"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = min($request->get('per_page', 10), 100);
            $search = $request->get('search');
            $status = $request->get('status');

            $query = User::query();

            // Search functionality
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            // Status filter
            if ($status) {
                $query->where('status', $status);
            }

            $users = $query->latest()
                          ->paginate($perPage);

            // Hide sensitive information
            $users->getCollection()->transform(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role ?? 'user',
                    'status' => $user->status ?? 'active',
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at
                ];
            });

            return response()->json([
                'message' => 'Users retrieved successfully',
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create a new user (Admin)",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", maxLength=255, example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", maxLength=255, example="john@example.com"),
     *             @OA\Property(property="password", type="string", minLength=8, example="password123"),
     *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user"),
     *             @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User created successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john@example.com"),
     *                 @OA\Property(property="role", type="string", example="user"),
     *                 @OA\Property(property="status", type="string", example="active"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', Password::defaults()],
                'role' => ['nullable', 'string', 'in:admin,user'],
                'status' => ['nullable', 'string', 'in:active,inactive']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->get('role', 'user'),
                'status' => $request->get('status', 'active'),
                'email_verified_at' => now() // Auto-verify for admin created users
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'status' => $user->status,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     summary="Get user details (Admin)",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User details retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User details retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john@example.com"),
     *                 @OA\Property(property="role", type="string", example="user"),
     *                 @OA\Property(property="status", type="string", example="active"),
     *                 @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function show(User $user): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'User details retrieved successfully',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role ?? 'user',
                    'status' => $user->status ?? 'active',
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve user details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}",
     *     summary="Update user (Admin)",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", maxLength=255, example="John Doe Updated"),
     *             @OA\Property(property="email", type="string", format="email", maxLength=255, example="john.updated@example.com"),
     *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="admin"),
     *             @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe Updated"),
     *                 @OA\Property(property="email", type="string", example="john.updated@example.com"),
     *                 @OA\Property(property="role", type="string", example="admin"),
     *                 @OA\Property(property="status", type="string", example="active"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, User $user): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'role' => ['nullable', 'string', 'in:admin,user'],
                'status' => ['nullable', 'string', 'in:active,inactive']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user->update($request->only(['name', 'email', 'role', 'status']));

            return response()->json([
                'message' => 'User updated successfully',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'status' => $user->status,
                    'updated_at' => $user->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{user}",
     *     summary="Delete user (Admin)",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Cannot delete your own account"
     *     )
     * )
     */
    public function destroy(Request $request, User $user): JsonResponse
    {
        try {
            // Prevent users from deleting their own account
            if ($request->user()->id === $user->id) {
                return response()->json([
                    'message' => 'Cannot delete your own account'
                ], 403);
            }

            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}/change-password",
     *     summary="Change user password (Admin)",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"password"},
     *             @OA\Property(property="password", type="string", minLength=8, example="newpassword123"),
     *             @OA\Property(property="password_confirmation", type="string", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password changed successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function changePassword(Request $request, User $user): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'confirmed', Password::defaults()]
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'Password changed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to change password',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}/toggle-status",
     *     summary="Toggle user status (Admin)",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User status toggled successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User status updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="inactive")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Cannot deactivate your own account"
     *     )
     * )
     */
    public function toggleStatus(Request $request, User $user): JsonResponse
    {
        try {
            // Prevent users from deactivating their own account
            if ($request->user()->id === $user->id) {
                return response()->json([
                    'message' => 'Cannot deactivate your own account'
                ], 403);
            }

            $currentStatus = $user->status ?? 'active';
            $newStatus = $currentStatus === 'active' ? 'inactive' : 'active';

            $user->update(['status' => $newStatus]);

            return response()->json([
                'message' => 'User status updated successfully',
                'data' => [
                    'id' => $user->id,
                    'status' => $newStatus
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to toggle user status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
