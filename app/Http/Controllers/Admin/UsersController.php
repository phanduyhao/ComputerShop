<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function user()
    {
        $users = User::where('level','0')->paginate(10);
        return view('admin.user.user',compact('users'),[
            'title' => 'Tài khoản người dùng'
        ]);
    }
    public function userAdmin()
    {
        $users = User::where('level','!=','0')->orderBy('level', 'asc')->paginate(10);
        return view('admin.user.userAdmin',compact('users'),[
            'title' => 'Tải khoản quản trị'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->authorize('create', User::class);
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|unique:users',
                'role' => 'required',
                'level' => 'required'
            ],[
                'name.required' => 'Vui lòng nhập tên !',
                'email.required' => 'Vui lòng nhập email',
                'email.unique' => 'Email này đã tồn tại',
                'role.required' => 'Vui lòng phân quyền',
                'level.required' => 'Vui lòng nhập level',
            ]);
            $user = new User;
            $user->name = $request->name;
            $name = $user->name;
            $avatar = $request->file('avatar'); // Lấy file ảnh từ file Upload
            if ($avatar) {
                $fileName = Str::slug($name) . '.jpg'; // Tên ảnh theo Slug Title
                $avatar->move(public_path('temp/images/avatars'), $fileName); // Di chuyển ảnh vào thư mục này

                $user->avatar = $fileName; // Lưu tên file ảnh theo slug Title
            }
            $user->email = $request->email;
            $user->role = $request->role;
            $user->level = $request->level;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back();
        } catch (AuthorizationException $e) {
            abort(403, 'Bạn không có quyền thực hiện');
        }
    }

    public function update(Request $request, User $user)
    {
         try {
            $this->authorize('create', User::class);
            $this->authorize('update', $user);
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
                'level' => 'required'
            ],[
                'name.required' => 'Vui lòng nhập tên !',
                'email.required' => 'Vui lòng nhập email',
                'role.required' => 'Vui lòng phân quyền',
                'level.required' => 'Vui lòng nhập level',
            ]);
            // Kiểm tra xem cate_id có tồn tại trong bảng Cate hay không

            $user->name = $request->name;
             $name = $user->name;
             $avatar = $request->file('avatar'); // Lấy file ảnh từ file Upload
             if ($avatar) {
                 $fileName = Str::slug($name) . '.jpg'; // Tên ảnh theo Slug Title
                 $avatar->move(public_path('temp/images/avatars'), $fileName); // Di chuyển ảnh vào thư mục này

                 $user->avatar = $fileName; // Lưu tên file ảnh theo slug Title
             }
            $user->email = $request->email;
            $user->role = $request->role;
             $user->level = $request->level;
             if ($request->has('password') && !empty($request->password)) {
                 $user->password = bcrypt($request->password);
             }
             $user->save();
            return redirect()->back();
         } catch (AuthorizationException $e) {
             abort(403, 'Bạn không có quyền thực hiện');
         }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // try {
            // $this->authorize('delete', $user);
            $user->delete();
            return response()->json(['message' => 'Người dùng đã được xóa thành công']);
        // } catch (AuthorizationException $e) {
            // abort(403, 'Bạn không có quyền thực hiện hành động này!');
        // }
    }

}
