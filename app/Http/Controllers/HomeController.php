<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use App\Models\GeneralSetting;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Category;
use App\Models\User;
use App\Models\Provider;
use App\Models\UserContact;
use App\Models\Page;
use App\Models\City;
use App\Models\Booking;
use App\Models\UserWallet;
use App\Models\Availability;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $banner = Banner::first();
        // $category = Category::limit(4)->get();
        $cities = City::all();
        $category = Category::select(['categories.*', DB::raw('count(services.category) as count')])
            ->leftJoin('services', 'services.category', '=', 'categories.cat_id')
            ->where('categories.status', '1')
            ->where('services.status', '1')
            ->where('services.approved', '1')
            ->groupBy('categories.cat_id')
            ->orderBy('categories.cat_id', 'desc')->limit(8)->get();
        $service = Service::select('services.*', 'categories.category_name', 'categories.category_slug')
            ->leftJoin('categories', 'categories.cat_id', '=', 'services.category')
            ->orderBy('services.service_id', 'desc')
            ->where('services.status', '1')
            ->where('services.approved', '1')
            ->limit(6)->get();
        return view('public.index', ['banner' => $banner, 'category' => $category, 'services' => $service, 'cities' => $cities]);
    }

    public function all_categories()
    {
        Paginator::useBootstrap();
        $category_list = Category::select(['categories.*', DB::raw('count(services.category) as count')])
            ->leftJoin('services', 'services.category', '=', 'categories.cat_id')
            ->where('categories.status', '1')
            ->where('services.status', '1')
            ->where('services.approved', '1')
            ->groupBy('categories.cat_id')
            ->orderBy('categories.cat_id', 'desc')
            ->paginate(10);
        return view('public.all-category', ['categories' => $category_list]);
    }

    public function footer_pages($slug)
    {
        // return $slug;
        $page_detail = Page::where('page_slug', $slug)->first();
        // return $page_detail;
        return view('public.single-page', ['page_detail' => $page_detail]);
    }

    public function cat_services($slug)
    {
        Paginator::useBootstrap();
        $category = Category::where('category_slug', $slug)->first();
        $services = Service::select('services.*', 'categories.category_name', 'categories.category_slug')
            ->leftJoin('categories', 'categories.cat_id', '=', 'services.category')
            ->where('services.category', $category->cat_id)
            ->where('services.status', '1')
            ->where('services.approved', '1')
            ->paginate(5);
        // return $category;
        return view('public.category', ['category' => $category, 'services' => $services]);
    }

    public function search(Request $request)
    {
        Paginator::useBootstrap();
        if ($request->input()) {
            $query = Service::select('services.*', 'categories.category_name', 'categories.category_slug')
                ->leftJoin('categories', 'categories.cat_id', '=', 'services.category')
                ->where('services.status', '1')
                ->where('services.approved', '1');

            // Safe search by service name
            if ($request->input('search') != '') {
                $search = $request->input('search');
                $query->where('services.service_name', 'LIKE', "%{$search}%");
            }

            // Safe search by location
            if ($request->input('location') != '') {
                $location = $request->input('location');
                $city = City::where('city_name', $location)->pluck('city_id')->first();
                if ($city) {
                    $query->where('services.location', $city);
                }
            }

            $result = $query->paginate();

            $cities = City::all();
            return view('public.search', ['request' => $request, 'services' => $result, 'cities' => $cities]);
        } else {
            return redirect('/');
        }
    }

    public function singlePage($text, $slug)
    {
        $service = Service::select('services.*', 'categories.category_name', 'categories.category_slug')
            ->leftJoin('categories', 'services.category', '=', 'categories.cat_id')
            ->where('services.service_slug', $slug)->first();

        $provider = User::select('*')->where('user_id', $service->provider)->first();

        $related = Service::select('services.*', 'categories.category_name', 'categories.category_slug')
            ->where('category', $service->category)
            // ->where('service_id','!=',$service->service_id)
            ->leftJoin('categories', 'services.category', '=', 'categories.cat_id')
            ->limit(10)
            ->get();
        $availability = Availability::where('provider', $service->provider)->get();
        return view('public.single', ['cat_slug' => $text, 'service' => $service, 'provider' => $provider, 'related' => $related, 'availability' => $availability]);
    }

    public function contact(Request $request)
    {
        if ($request->input()) {
            $request->validate([
                'user_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'description' => 'required',
            ]);

            $userContact = new UserContact();
            $userContact->user_name = $request->input("user_name");
            $userContact->email = $request->input("email");
            $userContact->phone = $request->input("phone");
            $userContact->description = $request->input("description");
            $result = $userContact->save();
            return $result;
        } else {
            return view('public.contact');
        }
    }


    public function book_service($text)
    {
        $user = Session::get('user_id');
        $service = Service::select('services.*', 'categories.category_name')
            ->leftJoin('categories', 'categories.cat_id', '=', 'services.category')
            ->where('service_slug', $text)
            ->first();
        $locations = City::get();
        $wallet = UserWallet::where('user', $user)->pluck('balance')->first();
        return view('public.book-service', ['service' => $service, 'locations' => $locations, 'wallet' => $wallet]);
    }


    public function submit_booking(Request $request)
    {
        $booking = new Booking();
        $booking->service = $request->service;
        $booking->user = session()->get('user_id');
        $booking->provider = $request->provider;
        $booking->location = $request->location;
        $booking->date = $request->date;
        $result = $booking->save();
        return $result;
    }
}
