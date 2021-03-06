<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactPageSendMessageRequest;
use App\Models\Logs\LogContactFormMessage;
use App\Models\PageContents\PageContent;
use App\Notifications\ContactFormMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class ContactPageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function show(): View
    {
        /** @var \App\Models\PageContents\PageContent $pageContent */
        $pageContent = PageContent::where('unique_key', 'contact_page_content')->sole();
        $pageContent->displaySeoMeta();
        $css = mix('/css/templates/front/contact/page/show.css');

        return view('templates.front.contact.page.show', compact('pageContent', 'css'));
    }

    /**
     * @param \App\Http\Requests\Contact\ContactPageSendMessageRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function sendMessage(ContactPageSendMessageRequest $request): RedirectResponse
    {
        Notification::route('mail', settings()->email)
            ->notify((new ContactFormMessage(
                $request->validated()['first_name'],
                $request->validated()['last_name'],
                $request->validated()['email'],
                $request->validated()['phone_number'],
                $request->validated()['message'],
            ))->locale(app()->getLocale()));
        Notification::route('mail', $request->validated()['email'])
            ->notify((new ContactFormMessage(
                $request->validated()['first_name'],
                $request->validated()['last_name'],
                $request->validated()['email'],
                $request->validated()['phone_number'],
                $request->validated()['message'],
                true
            ))->locale(app()->getLocale()));
        LogContactFormMessage::create(['data' => $request->validated()]);

        return back()->with('toast_success', __('Your message has been sent, we have emailed you a copy.'));
    }
}
