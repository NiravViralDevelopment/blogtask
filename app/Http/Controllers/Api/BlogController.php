<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogisLike;
Use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\LikeScope;

class BlogController extends Controller
{
    public function get_blogs(request $request){
        try
        {
            $data = Blog::query()->when(
            function (Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->search_key}%")
                ->orWhere('description', 'like', "%{$request->search_key}%")
                ->select('blogs.*')->orderBy('id',($request->latest_blogs)? 'DESC' : "ASC");
                })->select('blogs.*')->addFavorite()->orderBy('id','DESC');

                if($request->most_liked == 1){
                    $data = Blog::withCount('likes')->orderBy('likes_count', 'desc');
                }
                $result = paginate($data,($request->page ?? null));
                return ApiResponse($result);
        }catch (\Exception $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }catch (\Throwable $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }
    }

    public function create_blog(request $request){
        try
        {
            DB::beginTransaction();
            $en_uploaded = '';
            if ($request->file('image')){
                $image = $request->file('image');
                $en_uploaded = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/all_image');
                $image->move($destinationPath, $en_uploaded);
            }
            $data                = new Blog();
            $data->user_id       = Auth::id();
            $data->title         = $request->title;
            $data->description   = $request->description;
            $data->image         = $en_uploaded;
            $data->status        = 0;
            $data->save();
            $response = [
                'status' => 1,
                'message' => 'success',
            ];
            DB::commit();
            return ApiResponse($response);
        }catch (\Exception $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }catch (\Throwable $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }
    }


    public function blog_like(request $request){
        try
        {
            DB::beginTransaction();
            $existing_like = BlogisLike::where('blog_id',$request->blog_id)->where('user_id',Auth::id())->first();
            if (is_null($existing_like)) {
                BlogisLike::create([
                    'user_id'       => Auth::id(),
                    'blog_id'       => $request->blog_id,
                ]);
                $response = [
                    'status' => 1,
                    'message' => 'Blog Like successfully',
                ];
                DB::commit();
                return ApiResponse($response);

            } else {
                if (is_null($existing_like->deleted_at)) {
                    $existing_like->delete();
                    $response = [
                        'status' => 1,
                        'message' => 'Blog un-Like successfully',
                    ];
                    DB::commit();
                    return ApiResponse($response);
                }
            }
            $response = [
                'status' => 1,
                'message' => 'success',
            ];
            DB::commit();
            return ApiResponse($response);
        }catch (\Exception $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }catch (\Throwable $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }
    }
}
