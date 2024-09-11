<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function index()
    {
        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', '/')->first();
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function contact()
    {
        $pageTitle      = "Contact Us";
        $contactCon     = getContent('contact_us.content', true);
        $socialElements = getContent('social_icon.element', false, null, true);
        $sections       = Page::where('tempname', $this->activeTemplate)->where('slug', 'contact')->firstOrFail();
        return view($this->activeTemplate . 'contact', compact('pageTitle', 'contactCon', 'socialElements', 'sections'));
    }

    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();


        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }

    public function blogs()
    {
        $pageTitle = 'Blogs';
        $blogs     = Frontend::where('data_keys', 'blog.element')->latest()->paginate(getPaginate());
        $latest    = Frontend::latest()->where('data_keys', 'blog.element')->limit(10)->get();
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();
        return view($this->activeTemplate . 'blog', compact('pageTitle', 'blogs', 'latest', 'sections'));
    }

    public function blogDetails($slug, $id)
    {
        $pageTitle   = "Blog Details";
        $blog        = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();

        $blog->views += 1;
        $blog->save();

        $latestPosts = Frontend::latest()->where('data_keys', 'blog.element')->where('id', '!=', $id)->limit(10)->get();

        $seoContents['keywords']           = $blog->meta_keywords ?? [];
        $seoContents['social_title']       = $blog->data_values->title;
        $seoContents['description']        = strLimit(strip_tags($blog->data_values->description_nic), 150);
        $seoContents['social_description'] = strLimit(strip_tags($blog->data_values->description_nic), 150);
        $seoContents['image']              = getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '830x460');
        $seoContents['image_size']         = '830x460';
        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle', 'latestPosts', 'seoContents'));
    }

    public function login()
    {
        $pageTitle = 'Login';
        return view($this->activeTemplate . 'login', compact('pageTitle'));
    }



    public function subscribe(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:subscribers',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        $notify[] = ['success', 'Subscribed Successfully'];
        return response()->json(['success' => 'You have successfully subscribed']);
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        // $fontFile = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontFile = realpath('assets/font/FSAlbert-Regular.woff');
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        $general = gs();
        if ($general->maintenance_mode == Status::DISABLE) {
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view($this->activeTemplate . 'maintenance', compact('pageTitle', 'maintenance'));
    }
}
