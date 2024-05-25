<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(6);
        return view('admin.post.index',compact('posts',),[
            'title' => 'Quản lý bài viết'
        ]);
    }

    public function store(Request $request)
    {

        // Check kiểm tra giá trị được nhập hay chưa 
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'required|unique:posts',
        ],[
            'title.required' => 'Vui lòng nhập tiêu đề !',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.unique' => 'Slug này đã tồn tại',
        ]);

        $post = new Post; // Khởi tạo 1 Biến lưu bài viết mới 
        $post->Title = $request->title;
        $title = $post->Title;
        $thumb = $request->file('thumb'); // Lấy file ảnh từ file Upload
        if ($thumb) {
            $fileName = Str::slug($title) . '.jpg'; // Tên ảnh theo Slug Title
//                $avatar->storeAs('public/images/avatars', $fileName); // Lưu ảnh đã thêm vào đường dẫn này
            $thumb->move(public_path('temp/images/post'), $fileName); // Di chuyển ảnh vào thư mục này

            $post->thumb = $fileName; // Lưu tên file ảnh theo slug Title
        }
        $post->description = $request->desc;
        $post->slug = $request->slug;
        $post->active = $request->active ? 1 : 0;
        $post->ishot = $request->ishot ? 1 : 0;
        $post->isnewfeed = $request->isnewfeed ? 1 : 0;
        $post->content = $request->content;
        $post->save();
        // Chuyển hướng về trang hiển thị danh sách post hoặc trang khác tùy theo yêu cầu của bạn
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'required',
        ],[
            'title.required' => 'Vui lòng nhập tiêu đề !',
            'slug.required' => 'Vui lòng nhập slug',
        ]);
        // Kiểm tra xem post_id có tồn tại trong bảng Post hay không
        $post->Title = $request->title;
        $title = $post->Title;
        $thumb = $request->file('thumb'); // Lấy file ảnh từ file Upload
        if ($thumb) {
            $fileName = Str::slug($title) . '.jpg'; // Tên ảnh theo Slug Title
//                $avatar->storeAs('public/images/avatars', $fileName); // Lưu ảnh đã thêm vào đường dẫn này
            $thumb->move(public_path('temp/images/post'), $fileName); // Di chuyển ảnh vào thư mục này

            $post->thumb = $fileName; // Lưu tên file ảnh theo slug Title
        }
        $post->description = $request->desc;
        $post->slug = $request->slug;
        $post->active = $request->active ? 1 : 0;
        $post->ishot = $request->ishot ? 1 : 0;
        $post->isnewfeed = $request->isnewfeed ? 1 : 0;
        $post->content = $request->content;
        $post->save();
        // Chuyển hướng về trang hiển thị danh sách post hoặc trang khác tùy theo yêu cầu của bạn
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        // Chuyển hướng về trang danh sách post hoặc trang khác (tuỳ ý)
        return redirect()->back();
    }

    public function deleteAllPosts() {
        Post::truncate(); // Xóa tất cả bản ghi
        return redirect()->back();
    }
}
