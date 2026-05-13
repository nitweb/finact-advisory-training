<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Circular;
use App\Models\Client;
use App\Models\Enlistment;
use App\Models\Finance;
use App\Models\Gallery;
use App\Models\OurContents;
use App\Models\OurTeam;
use App\Models\Publications;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SuccessfulPortfolios;
use App\Models\Testimonial;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\User;
use App\Models\WhoWeAre;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Index()
    {
        $slider = Slider::where('status', 'active')->orderBy('id', 'desc')->get();

        $about_us = AboutUs::where('id', 1)->latest()->get()->firstOrFail();

        $services = Service::where('status', 'active')->orderBy('id', 'asc')->get();

        $blog = Blog::where('status', 'active')->latest()->take(3)->get();

        $our_team = OurTeam::where('status', 'active')->orderBy('id', 'asc')->get();

        $top_level_team = $our_team
            ->filter(function ($item) {
                return $item->type == 'top_level';
            })
            ->sortByDesc('id');

        $client = Client::where('status', 'active')->orderBy('id', 'desc')->get();

        $testimonials = Testimonial::where('status', 'active')->orderBy('id', 'desc')->get();

        return view('frontend.index', compact('slider', 'about_us', 'services', 'our_team', 'top_level_team', 'client', 'blog', 'testimonials'));
    } // End Method

    public function ServiceDetails($slug)
    {
        $service_list = Service::where('status', 'active')->orderBy('id', 'asc')->get();
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('frontend.details.service_details', compact('service_list', 'service'));
    } // End Method

    public function AllServiceList()
    {
        $services = Service::where('status', 'active')->orderBy('id', 'asc')->get();
        return view('frontend.pages.services', compact('services'));
    } // End Method

    public function AboutUs()
    {
        $about_us = AboutUs::where('id', 1)->latest()->get()->firstOrFail();

        $about_message = AboutUs::where('id', 2)->latest()->get()->firstOrFail();

        $team = OurTeam::where('status', 'active')->latest()->get();

        $top_level_team = $team->filter(function ($item) {
            return $item->type == 'top_level';
        });

        $student_level_team = $team
            ->filter(function ($item) {
                return $item->type == 'student_level';
            })
            ->sortBy('id');

        $our_mission = OurContents::where('id', 1)->latest()->get()->firstOrFail();
        $our_vision = OurContents::where('id', 2)->latest()->get()->firstOrFail();
        $shared_beliefs = OurContents::where('id', 3)->latest()->get()->firstOrFail();
        $organizational_strength = OurContents::where('id', 4)->latest()->get()->firstOrFail();
        $operational_strength = OurContents::where('id', 5)->latest()->get()->firstOrFail();
        $commitment = OurContents::where('id', 6)->latest()->get()->firstOrFail();

        return view('frontend.pages.about_us', compact('about_us', 'about_message', 'team', 'top_level_team', 'student_level_team', 'our_mission', 'our_vision', 'shared_beliefs', 'organizational_strength', 'operational_strength', 'commitment'));
    } // End Method

    public function ImportantEnlistment()
    {
        $enlistment = Enlistment::latest()->get()->firstOrFail();
        return view('frontend.pages.important_enlistment', compact('enlistment'));
    } // End Method

    public function Client()
    {
        $client = Client::where('status', 'active')->latest()->get();
        return view('frontend.pages.client', compact('client'));
    } // End Method

    public function Gallery()
    {
        $gallery = Gallery::where('status', 'active')->latest()->get();
        return view('frontend.pages.gallery', compact('gallery'));
    } // End Method

    public function GalleryDetails($slug)
    {
        $gallery = Gallery::findOrfail($slug);

        return view('frontend.details.gallery_details', compact('gallery'));
    } // End Method

    public function ContactUs()
    {
        $site_setting = Setting::firstOrFail();
        $services = Service::where('status', 'active')->latest()->get();
        return view('frontend.pages.contact_us', compact('site_setting', 'services'));
    } // End Method

    public function BlogList()
    {
        $blog = Blog::where('status', 'active')->latest()->paginate(9);
        return view('frontend.pages.blog', compact('blog'));
    }

    public function BlogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $author = User::where('id', $blog->created_by)->firstOrFail()->name;
        $recent_blogs = Blog::where('status', 'active')->latest()->take(5)->get();

        return view('frontend.details.blog_details', compact('blog', 'author', 'recent_blogs'));
    } // End Method

    public function BlogSearch(Request $request)
    {
        $query = $request->get('q', '');

        $blogs = Blog::where('status', 'active')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")->orWhereHas('blogDetail', function ($q) use ($query) {
                    $q->where('long_description', 'like', "%{$query}%");
                });
            })
            ->with('blogDetail.category')
            ->latest()
            ->take(8)
            ->get()
            ->map(function ($blog) {
                return [
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'image' => asset($blog->blogDetail->blog_image),
                    'category' => $blog->blogDetail->category->name ?? 'Uncategorized',
                    'date' => \Carbon\Carbon::parse($blog->date)->format('F j, Y'),
                    'url' => route('frontend.blog.details', $blog->slug),
                ];
            });

        return response()->json($blogs);
    }

    public function PrivacyPolicy()
    {
        return view('frontend.pages.privacy_policy');
    } // End Method

    public function TermsConditions()
    {
        return view('frontend.pages.terms_conditions');
    } // End Method

    public function TeamList()
    {
        $team = OurTeam::where('status', 'active')->orderBy('id', 'desc')->get();
        $top_level_team = $team->filter(function ($item) {
            return $item->type == 'top_level';
        });
        $middle_level_team = $team->filter(function ($item) {
            return $item->type == 'middle_level';
        });
        $student_level_team = $team->filter(function ($item) {
            return $item->type == 'student_level';
        });
        $team_founder = OurTeam::where('status', 'active')->where('type', 'founder')->get()->firstOrFail();
        return view('frontend.pages.our_team', compact('team', 'top_level_team', 'middle_level_team', 'student_level_team', 'team_founder'));
    } // End Method

    public function TeamDetails($slug)
    {
        $team = OurTeam::where('slug', $slug)->firstOrFail();
        return view('frontend.details.team_details', compact('team'));
    } // End Method

    public function Career()
    {
        $career = Career::where('status', 'active')->latest()->get();
        return view('frontend.pages.career', compact('career'));
    } // End Method

    public function CareerDetails($slug)
    {
        $job_application = Career::where('slug', $slug)->firstOrFail();
        return view('frontend.details.job_details', compact('job_application'));
    } // End Method

    public function CareerDetailsApply($id)
    {
        $career_apply = Career::findOrFail($id);
        return view('frontend.pages.apply_for_career_by_id', compact('career_apply'));
    }

    public function CareerApply()
    {
        $career = Career::where('status', 'active')->latest()->get();
        return view('frontend.pages.apply_for_career', compact('career'));
    } // End Method

    public function showProfile()
    {
        $successful_portfolios = SuccessfulPortfolios::firstOrFail();
        // dd($successful_portfolios);
        return view('frontend.pages.profile', compact('successful_portfolios'));
    }

    public function Publications()
    {
        $publications_data = Publications::latest()->get();
        return view('frontend.pages.publications', compact('publications_data'));
    } // End Method

    public function NoticeCircular()
    {
        $circular_data = Circular::latest()->get();
        return view('frontend.pages.circular', compact('circular_data'));
    } // End Method

    public function RemoteSupport()
    {
        $finance_info = Finance::firstOrFail();
        return view('frontend.pages.remote_support', compact('finance_info'));
    } // End Method

    public function TrainingDevelopment()
    {
        $training_list = Training::where('status', 'active')->latest()->paginate(9);
        return view('frontend.pages.training_development', compact('training_list'));
    } // End Method

    public function TrainingDevelopmentDetails($slug)
    {
        $training_details = Training::with('trainers')->where('slug', $slug)->firstOrFail();
        return view('frontend.details.training_details', compact('training_details'));
    }

    public function trainerDetails($slug)
    {
        $trainer = Trainer::where('slug', $slug)->where('status', 'active')->firstOrFail();

        $trainings = $trainer->trainings()->where('status', 'active')->get();

        return view('frontend.details.trainer_details', compact('trainer', 'trainings'));
    }

    public function EnrollPage()
    {
        return view('frontend.pages.enroll');
    }

    public function Testimonials()
    {
        $testimonials = Testimonial::where('status', 'active')->orderBy('id', 'desc')->get();
        return view('frontend.pages.testimonials', compact('testimonials'));
    } // End Method
}
