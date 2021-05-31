<?php

namespace App\Http\Controllers;

use App\DataTables\ManagerDataTable;
use App\DataTables\UserDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource./////
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        $this->authorize('all',new User);
        return $dataTable->render('user.index');
    }

    public function showManager(UserDataTable $dataTable)
    {
        $this->authorize('all',new User);
        return $dataTable->with(['role' => 'manager'])->render('user.index');
    }

    public function showReceptionist(UserDataTable $dataTable)
    {
        $this->authorize('view',new User);
        return $dataTable->with(['role' => 'receptionist'])->render('user.index');
    }

    public function showClient(UserDataTable $dataTable)
    {
        $this->authorize('view',new User);
        return $dataTable->with(['role' => 'client'])->render('user.index');
    }

    public function showAdmin(UserDataTable $dataTable)
    {
        $this->authorize('view',new User);
        return $dataTable->with(['role' => 'admin'])->render('user.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View|
     * \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
//        User::create($request->all());

        // Handle File Upload
        if ($request->hasFile('avatar')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public/avatar', $fileNameToStore);

            // make thumbnails
            $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('avatar')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/avatar/'.$thumbStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $data=$request->all();
        $data['avatar'] = $fileNameToStore;
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('success', 'User added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        $this->authorize('view',$user);
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $this->authorize('view',$user);

        //Check if post exists before deleting
        if (!isset($user)) {
            return redirect('/home')->with('error', 'No User Found');
        }

        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(StoreUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view',$user);

        if ($request->hasFile('avatar')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public/avatar', $fileNameToStore);
            Storage::delete('public/avatar/'.$user->avatar);

            // make thumbnails
            $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('avatar')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/avatar/'.$thumbStore);
        }
//        dd($request->input('country'));
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->national_id = $request->input('national_id');
        $user->role = $request->input('role');

        $reqPass = $request->input('password');
        $user->password = $reqPass?Hash::make($reqPass):$user->password;


        $approval = $request->input('approval_id');
        $user->approval_id = $approval?$approval:$user->approval_id;


        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->country = $request->input('country');

        if ($request->hasFile('avatar')) {
            $user->avatar = $fileNameToStore;
        }

        $user->save();
        return redirect()
            ->route(
                'user.edit',
                ['user'=>$user->id]
            )
            ->with('success', 'User updated successfully');
    }

    /**`
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        //Check if post exists before deleting
        if (!isset($user)) {
            return redirect('/home')->with('error', 'No user Found');
        }


        $user->delete();
        return redirect('/user')->with('success', 'user Removed');
    }

    public function showAllDeletedUsers()
    {
        $users = User::onlyTrashed()->get();
        return view('user.deletedusers')->with('users', $users);
    }


    public function restoreDeletedUser($id)
    {
        $user = User::where('id', $id)->withTrashed()->first();
        $user->restore();
        return redirect('/user')->with('success', 'User restored');
    }

    public function deletePermanently($id)
    {
        $user = User::where('id', $id)->withTrashed()->first();
        if($user->avatar != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/avatar/'.$user->avatar);
        }

        $user->forceDelete();

        return redirect('/user')->with('success', 'User Deleted Permanently');
    }

}
