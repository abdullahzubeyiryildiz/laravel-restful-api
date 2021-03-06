<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Api;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;




class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 10;

        $qb = User::query();
        if ($request->has('q'))
            $qb->where('name', 'like', '%' . $request->query('q') . '%');
        if ($request->has('sortBy'))
            $qb->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));

        $data = $qb->offset($offset)->limit($limit)->get();

        $data->each->setAppends(['full_name']); //Dinamik Sadece index metodunda birleştirme yapar


        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserStoreRequest $request)
    {

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email_verified_at = now();
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(10);
        $user->save();

         return response([
            "data" => $user,
            "message" => "User created."
        ], 201);

       /* return $this->apiResponse(ResultType::Success, $user,'User created.', 201); */
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param User  $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response([
            "data" => $user,
            "message" => "User updated."
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return Response
     * @throws  \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response([
            'message' => 'User deleted'
        ], 200);
    }

    public function custom1() {

        // $user2 = User::find(2);
         UserResource::withoutWrapping();
        //  return new UserResource($user2);

        $users = User::all();
//        return UserResource::collection($users);
//        return new UserCollection($users); //Ayrı bir dosyadan aşağıdaki işlemi bağlanıkurup çekmek için istiyorsak

        return UserResource::collection($users)->additional([
            'meta' => [
                'total_users' => $users->count(),
                'custom' => 'value'
            ]
        ]);

    }
}
