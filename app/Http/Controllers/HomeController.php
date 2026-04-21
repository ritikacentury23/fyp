<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\PostComment;
use App\Models\Wishlist;
use App\Rules\MatchOldPassword;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(){

        return view('user.index');
    }

    public function profile(){

        $profile=Auth()->user();
       
        return view('user.profile')->with('profile',$profile);
    }


    public function dashboard(){
        $userId = auth()->id();
        $totalOrders    = Order::where('user_id', $userId)->count();
        $pendingOrders  = Order::where('user_id', $userId)->where('status', 'new')->count();
        $totalReviews   = ProductReview::where('user_id', $userId)->count();
        $wishlistCount  = Wishlist::where('user_id', $userId)->whereNull('cart_id')->count();
        $recentOrders   = Order::where('user_id', $userId)->orderBy('id', 'DESC')->limit(5)->get();

        return view('user.dashboard', compact(
            'totalOrders', 'pendingOrders', 'totalReviews', 'wishlistCount', 'recentOrders'
        ));
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
       
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'house_no' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
        ]);
    
       
        $status = $user->update($request->only(['name', 'phone', 'city', 'postal_code', 'house_no', 'address']));
    
       
        if ($status) {
            return redirect()->back()->with('success', 'Successfully updated your profile');
        } else {
            return redirect()->back()->with('error', 'Please try again!');
        }
    }
    
    
    public function orderIndex()
    {

        $orders=Order::with('user', 'orderItems', 'shipping')->orderBy('id','ASC')->where('user_id',auth()->user()->id)->paginate(10);
        return view('user.order')->with('orders',$orders);
    }
    public function userOrderDelete($id)
    {
        $order=Order::find($id);
        if($order){
           if($order->status=="process" || $order->status=='delivered' || $order->status=='cancel'){
                return redirect()->back()->with('error','You can not delete this order now');
           }
           else{
                $status=$order->delete();
                if($status){
                    request()->session()->flash('success','Order Successfully deleted');
                }
                else{
                    request()->session()->flash('error','Order can not deleted');
                }
                return redirect()->route('user.order.index');
           }
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    }

    public function orderShow($id)
    {
        $order=Order::with('user', 'orderItems', 'shipping')->findorfail($id);
       
       
        return view('user.ordershow')->with('order',$order);
    }
    public function productReviewStore(Request $request)
    {
       
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rate' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);
    
        $data = $request->only(['product_id', 'rate', 'review']);
        $data['user_id'] = auth()->id(); 
    
        $status = ProductReview::create($data);
    
        if ($status) {
            return redirect()->back()->with('success', 'Your review has been submitted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function productReviewIndex(){

        $reviews=ProductReview::getAllUserReview();

        return view('user.review.index')->with('reviews',$reviews);
    }

    public function productReviewEdit($id)
    {
        $review=ProductReview::find($id);
        // return $review;
        return view('user.review.edit')->with('review',$review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewUpdate(Request $request, $id)
    {
        $review=ProductReview::find($id);
        if($review){
            $data=$request->all();
            $status=$review->fill($data)->update();
            if($status){
                request()->session()->flash('success','Review Successfully updated');
            }
            else{
                request()->session()->flash('error','Something went wrong! Please try again!!');
            }
        }
        else{
            request()->session()->flash('error','Review not found!!');
        }

        return redirect()->route('user.productreview.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewDelete($id)
    {
        $review=ProductReview::find($id);
        $status=$review->delete();
        if($status){
            request()->session()->flash('success','Successfully deleted review');
        }
        else{
            request()->session()->flash('error','Something went wrong! Try again');
        }
        return redirect()->route('user.productreview.index');
    }

    public function userComment()
    {
        $comments=PostComment::getAllUserComments();
        return view('user.comment.index')->with('comments',$comments);
    }
    public function userCommentDelete($id){
        $comment=PostComment::find($id);
        if($comment){
            $status=$comment->delete();
            if($status){
                request()->session()->flash('success','Post Comment successfully deleted');
            }
            else{
                request()->session()->flash('error','Error occurred please try again');
            }
            return back();
        }
        else{
            request()->session()->flash('error','Post Comment not found');
            return redirect()->back();
        }
    }
    public function userCommentEdit($id)
    {
        $comments=PostComment::find($id);
        if($comments){
            return view('user.comment.edit')->with('comment',$comments);
        }
        else{
            request()->session()->flash('error','Comment not found');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userCommentUpdate(Request $request, $id)
    {
        $comment=PostComment::find($id);
        if($comment){
            $data=$request->all();
            // return $data;
            $status=$comment->fill($data)->update();
            if($status){
                request()->session()->flash('success','Comment successfully updated');
            }
            else{
                request()->session()->flash('error','Something went wrong! Please try again!!');
            }
            return redirect()->route('user.post-comment.index');
        }
        else{
            request()->session()->flash('error','Comment not found');
            return redirect()->back();
        }

    }

    public function changePassword(){
        return view('user.layouts.userPasswordChange');
    }

    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password'      => ['required', new MatchOldPassword],
            'new_password'          => 'required|string|min:8',
            'new_confirm_password'  => 'required|same:new_password',
        ]);

        auth()->user()->update(['password' => Hash::make($request->new_password)]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

}
