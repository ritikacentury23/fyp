<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
class FrontendController extends Controller
{
   
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

   public function home(){

    $hotproducts = Product::where('status','active')
                    ->where('condition','hot')
                    ->orderBy('price','DESC')
                    ->get();

    $featured = Product::where('status','active')
                    ->where('is_featured',1)
                    ->where('condition','featured')
                    ->orderBy('price','DESC')
                    ->limit(2)
                    ->get();

                
    $banners = Banner::where('status','active')
                    ->orderBy('id','DESC')
                    ->limit(3)
                    ->get();

    $products = Product::where('status','active')
                    ->orderBy('id','DESC')
                    ->limit(8)
                    ->get();

    $category = Category::where('status','active')
                  
                    ->orderBy('title','ASC')
                    ->get();

                  
                  
    return view('index')
            ->with('hotproducts',$hotproducts)
            ->with('featured',$featured)
            ->with('banners',$banners)
            ->with('product_lists',$products)
            ->with('category_lists',$category);
}

    public function productDetail($slug)
    {
        $product_detail = Product::with(['reviews.user_info'])->where('slug', $slug)->firstOrFail();

        $related_products = Product::where('cat_id', $product_detail->cat_id)
            ->where('id', '!=', $product_detail->id)
            ->latest()
            ->take(4)
            ->get();

        $avgRating   = $product_detail->reviews->avg('rate') ?? 0;
        $reviewCount = $product_detail->reviews->count();

        return view('productdetail', compact('product_detail', 'related_products', 'avgRating', 'reviewCount'));
    }

    public function logout()
{
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login')->with('success', 'Logged out successfully');
}
    
 public function productGrids()
    {
        $products = $this->getFilteredProducts(9);
        $recent_products = Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        return view('product-grids')
            ->with('products', $products)
            ->with('recent_products', $recent_products);
    }
 
    /**
     * Fetch product lists with filtering and sorting
     */
    public function productLists()
    {
        $products = $this->getFilteredProducts(6);
        $recent_products = Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        return view('product-lists')
            ->with('products', $products)
            ->with('recent_products', $recent_products);
    }
 
    /**
     * Centralized filtering logic - Reusable across all product views
     */
    private function getFilteredProducts($defaultPerPage = 9)
    {
        $query = Product::query();
 
        // Filter by categories
        if (!empty($_GET['category'])) {
            $slug = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')
                ->whereIn('slug', $slug)
                ->pluck('id')
                ->toArray();
            $query->whereIn('cat_id', $cat_ids);
        }
 
        // Filter by brands
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')
                ->whereIn('slug', $slugs)
                ->pluck('id')
                ->toArray();
            $query->whereIn('brand_id', $brand_ids);
        }
 
        // Filter by price range
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            if (isset($price[0]) && is_numeric($price[0]) && isset($price[1]) && is_numeric($price[1])) {
                $query->whereBetween('price', [(float)$price[0], (float)$price[1]]);
            }
        }
 
        // Sort by specified field
        if (!empty($_GET['sortBy'])) {
            switch ($_GET['sortBy']) {
                case 'title':
                    $query->orderBy('title', 'ASC');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'ASC');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'DESC');
                    break;
                case 'newest':
                    $query->orderBy('id', 'DESC');
                    break;
                default:
                    $query->orderBy('id', 'DESC');
            }
        } else {
            $query->orderBy('id', 'DESC');
        }
 
        // Apply status filter and pagination
        $perPage = !empty($_GET['show']) && is_numeric($_GET['show']) ? (int)$_GET['show'] : $defaultPerPage;
        
        return $query->where('status', 'active')
            ->paginate($perPage)
            ->appends(request()->query());
    }
 
    /**
     * Handle product filtering via form submission
     */
    public function productFilter(Request $request)
    {
        $data = $request->all();
        $queryString = '';
 
        // Build query string for categories
        if (!empty($data['category'])) {
            $queryString .= '&category=' . implode(',', $data['category']);
        }
 
        // Build query string for brands
        if (!empty($data['brand'])) {
            $queryString .= '&brand=' . implode(',', $data['brand']);
        }
 
        // Build query string for price range
        if (!empty($data['price_range'])) {
            $queryString .= '&price=' . $data['price_range'];
        }
 
        // Build query string for sort
        if (!empty($data['sortBy'])) {
            $queryString .= '&sortBy=' . $data['sortBy'];
        }
 
        // Build query string for items per page
        if (!empty($data['show'])) {
            $queryString .= '&show=' . $data['show'];
        }
 
        // Redirect to appropriate route
        if ($request->is('e-shop.loc/product-grids')) {
            return redirect()->route('product-grids', substr($queryString, 1));
        } else {
            return redirect()->route('product-lists', substr($queryString, 1));
        }
    }
 
    /**
     * Search products by title, slug, description, summary, or price
     */
    public function productSearch(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $recent_products = Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        $products = Product::where('status', 'active')
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('slug', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('summary', 'like', "%{$searchTerm}%");
                    // Remove price search if it causes issues
                    // ->orWhere('price', 'like', "%{$searchTerm}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(9)
            ->appends(request()->query());
 
        return view('product-grids')
            ->with('products', $products)
            ->with('recent_products', $recent_products)
            ->with('search_term', $searchTerm);
    }
 
    /**
     * Get products by brand
     */
    public function productBrand(Request $request)
    {
        $products = Brand::getProductByBrand($request->slug);
        $recent_products = Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        $view = request()->is('e-shop.loc/product-grids') ? 'product-grids' : 'product-lists';
 
        return view($view)
            ->with('products', $products->products)
            ->with('recent_products', $recent_products)
            ->with('brand_filter', $request->slug);
    }
 
    /**
     * Get products by category
     */
    public function productCat(Request $request)
    {
        $products = Category::getProductByCat($request->slug);
        $recent_products = Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        $view = request()->is('e-shop.loc/product-grids') ? 'product-grids' : 'product-lists';
 
        return view($view)
            ->with('products', $products->products)
            ->with('recent_products', $recent_products)
            ->with('category_filter', $request->slug);
    }
 
    /**
     * Get products by subcategory
     */
    public function productSubCat(Request $request)
    {
        $products = Category::getProductBySubCat($request->sub_slug);
        $recent_products = Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        $view = request()->is('e-shop.loc/product-grids') ? 'product-grids' : 'product-lists';
 
        return view($view)
            ->with('products', $products->sub_products)
            ->with('recent_products', $recent_products)
            ->with('subcategory_filter', $request->sub_slug);
    }
 
    // ==================== BLOG METHODS ====================
 
    /**
     * Display blog posts with filtering
     */
    public function blog()
    {
        $query = Post::query();
 
        // Filter by category
        if (!empty($_GET['category'])) {
            $slug = explode(',', $_GET['category']);
            $cat_ids = PostCategory::select('id')
                ->whereIn('slug', $slug)
                ->pluck('id')
                ->toArray();
            $query->whereIn('post_cat_id', $cat_ids);
        }
 
        // Filter by tag
        if (!empty($_GET['tag'])) {
            $slug = explode(',', $_GET['tag']);
            $tag_ids = PostTag::select('id')
                ->whereIn('slug', $slug)
                ->pluck('id')
                ->toArray();
            $query->whereIn('post_tag_id', $tag_ids);
        }
 
        $perPage = !empty($_GET['show']) ? (int)$_GET['show'] : 9;
        $posts = $query->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->paginate($perPage)
            ->appends(request()->query());
 
        $recent_posts = Post::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        return view('blog')
            ->with('posts', $posts)
            ->with('recent_posts', $recent_posts);
    }
 
    /**
     * Display single blog post detail
     */
    public function blogDetail($slug)
    {
        $post = Post::getPostBySlug($slug);
        $recent_posts = Post::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        return view('blog-detail')
            ->with('post', $post)
            ->with('recent_posts', $recent_posts);
    }
 
    /**
     * Search blog posts
     */
    public function blogSearch(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $recent_posts = Post::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        $posts = Post::where('status', 'active')
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('quote', 'like', "%{$searchTerm}%")
                    ->orWhere('summary', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('slug', 'like', "%{$searchTerm}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(8)
            ->appends(request()->query());
 
        return view('blog')
            ->with('posts', $posts)
            ->with('recent_posts', $recent_posts)
            ->with('search_term', $searchTerm);
    }
 
    /**
     * Handle blog filtering via form submission
     */
    public function blogFilter(Request $request)
    {
        $data = $request->all();
        $queryString = '';
 
        if (!empty($data['category'])) {
            $queryString .= '&category=' . implode(',', $data['category']);
        }
 
        if (!empty($data['tag'])) {
            $queryString .= '&tag=' . implode(',', $data['tag']);
        }
 
        return redirect()->route('blog', substr($queryString, 1));
    }
 
    /**
     * Get blog posts by category
     */
    public function blogByCategory(Request $request)
    {
        $post = PostCategory::getBlogByCategory($request->slug);
        $recent_posts = Post::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        return view('blog')
            ->with('posts', $post->post)
            ->with('recent_posts', $recent_posts);
    }
 
    /**
     * Get blog posts by tag
     */
    public function blogByTag(Request $request)
    {
        $post = Post::getBlogByTag($request->slug);
        $recent_posts = Post::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
 
        return view('blog')
            ->with('posts', $post)
            ->with('recent_posts', $recent_posts);
    }
 
    // ==================== AUTHENTICATION METHODS ====================
 
    /**
     * Show login form
     */
    public function login()
    {
        return view('frontend.login');
    }
 
    /**
     * Handle login submission
     */
    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
 
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status' => 'active'])) {
            Session::put('user', $credentials['email']);
            $request->session()->flash('success', 'Successfully logged in');
            return redirect()->route('home');
        }
 
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid email and password. Please try again!');
    }
 
    /**
     * Show registration form
     */
    public function register()
    {
        return view('frontend.register');
    }
 
    /**
     * Handle registration submission
     */
    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required|min:2',
            'email' => 'string|required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
 
        $user = $this->create($validated);
 
        if ($user) {
            Session::put('user', $validated['email']);
            $request->session()->flash('success', 'Successfully registered');
            return redirect()->route('home');
        }
 
        return redirect()->back()
            ->withInput()
            ->with('error', 'Registration failed. Please try again!');
    }
 
    /**
     * Create a new user
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'active'
        ]);
    }
 
    // ==================== NEWSLETTER & CONTACT ====================
 
    /**
     * Subscribe email to newsletter
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'subscriber_email' => 'required|email'
        ]);
 
        try {
            if (Newsletter::isSubscribed($request->subscriber_email)) {
                return redirect()->back()->with('error', 'Email already subscribed');
            }
 
            Newsletter::subscribe($request->subscriber_email);
            return redirect()->back()->with('success', 'Email successfully subscribed');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Subscription failed: ' . $e->getMessage());
        }
    }
 
    /**
     * Store contact form submission
     */
    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);
 
        try {
            contact::create($validated);
            return redirect()->back()->with('success', 'Your message has been submitted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit message: ' . $e->getMessage());
        }
    }
 
    // ==================== PASSWORD RESET ====================
 
    /**
     * Show forgot password form
     */
    public function showForgotForm()
    {
        return view('forgetpassword');
    }
 
    /**
     * Send password reset link
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
 
        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Reset link sent to your email.')
            : back()->withErrors(['email' => __($status)]);
    }
 
    /**
     * Show reset password form
     */
    public function showResetForm($token)
    {
        return view('reset', ['token' => $token]);
    }
 
    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
 
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
 
                Auth::login($user);
            }
        );
 
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('home')->with('success', 'Password has been reset!')
            : back()->withErrors(['email' => [__($status)]]);
    }

        public function aboutUs() {
        $aboutus = AboutUs::first();
        return view('aboutus', compact('aboutus'));
    }
    

    public function contact(){
        return view('contact');
    }

}
