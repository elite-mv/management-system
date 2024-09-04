@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')


@section('title', 'Home')

@section('body')
    <div class="container-fluid">
        <div class="row" style="display: flex; justify-content: right; gap: 0 15px;">

            <div class="col-12 p-3 text-center m-1 mb-3" style="border-radius: 15px !important;">
                <div class="p-4 bg-white"
                     style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; border: 1px solid #000; border-radius: 15px; position: relative;">
                    <div class="bg-danger border border-dark py-auto"
                         style="position: absolute; top: -22px; left: 25px; margin: 0; padding: 0 10px 0 10px;">
                        <b><h5 class="m-0 p-0 px-1 py-2 text-white">WHAT`S NEW</h5></b>
                    </div>
                    <div class="w-100 text-start" style="overflow-y: auto; height: 75vh">
                        <small>
                            <p class="ms-4 text-danger">5 SECRET PIN ARE IMPLEMENTED</p>
                            <p class="ms-5">
                                Added as an additional security.
                                <br><br>
                                Can be updated at [My Profile].
                            </p>
                        </small>
                        <small>
                            <p class="ms-4 text-danger">EMAIL NOTIFICATIONS ARE IMPLEMENTED</p>
                            <p class="ms-5">
                                Submitting a checked priority request notifies finance.
                                <br><br>
                                Submitting a unchecked priority request notifies book keeper.
                                <br><br>
                                Commenting on a request notifies requestor, book keeper, accountant, finance and
                                auditor.
                                <br><br>
                                Check your notifications by accessing your webmail via [entity website + /webmail] or by
                                adding your corporate email to an email application.
                                <br><br><br>
                                Sample of [entity website + /webmail]:
                                <br><br>
                                - eliteacesinc.com/webmail
                            </p>
                        </small>
                        <small>
                            <p class="ms-4 text-danger">GROUP MESSAGE IS IMPLEMENTED</p>
                            <p class="ms-5">
                                The messages on the [Group Message] can be seen by everyone.
                                <br><br>
                                Leaving a message notifies everyone.
                            </p>
                        </small>
                        <small>
                            <p class="ms-4 text-danger">LOGS ARE IMPLEMENTED</p>
                            <p class="ms-5">
                                The system creates history of events or changes that happens on the request form.
                                <br><br>
                                Log records the activity or event that happened and who triggers it.
                            </p>
                        </small>
                        <small>
                            <p class="ms-4 text-danger">AUTO SAVE IS IMPLEMENTED</p>
                            <p class="ms-5">
                                When the system detect any changes to the request form it automatically saves it.
                            </p>
                        </small>
                        <small>
                            <p class="ms-4 text-danger">MY PROFILE IS IMPLEMENTED</p>
                            <p class="ms-5">
                                The system allows user to update their username and password.
                                <br><br><br>
                                Disclaimer:
                                <br><br>
                                - The Management System does not update the password of your corporate email.
                                <br><br>
                                - Your Management System account is seperate from your corporate email.
                            </p>
                        </small>
                        <small>
                            <p class="ms-4 text-danger">VIEW REQUEST IS IMPLEMENTED</p>
                            <p class="ms-5">
                                The system allows user to download the request form in PDF format, see the logs, add
                                attachments to the requested items and comment on their request.
                            </p>
                        </small>
                        <small>
                            <p class="ms-4 text-danger">SUBMIT REQUEST IS IMPLEMENTED</p>
                            <p class="ms-5">
                                The [Request] page allows user to submit a request, choose entity, add items, delete
                                items,
                                update items, attach multiple images and set priority.
                                <br><br>
                                The [Request] page automatically do all the calculations for the total of all items.
                                <br><br>
                                The [Request] page only accepts positive integers, deleting an input will auto change
                                the
                                current value to 1.
                                <br><br>
                                The [My Request] page contains the history of all the request made by the user.
                            </p>
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3 text-center m-1 mb-3" style="border-radius: 15px !important;">
                <div class="p-4 bg-white"
                     style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; border: 1px solid #000; border-radius: 15px; position: relative;">
                    <div class="bg-danger border border-dark py-auto"
                         style="position: absolute; top: -22px; left: 25px; margin: 0; padding: 0 10px 0 10px;">
                        <b><h5 class="m-0 p-0 px-1 py-2 text-white">KEEP ENCOUNTERING ERRORS?</h5></b>
                    </div>
                    <div class="w-100 text-start" style="overflow-y: auto; height: 75vh">
                        <small>
                            <p class="ms-4 text-danger">QUICK TIPS #1</p>
                            <p class="ms-5">
                                Try to logout the system and do a reload.
                                <br><br><br>
                                For Mac OS User:
                                <br><br>
                                - Press [Command] + [Shift] + [R] once.
                                <br><br><br>
                                For Window OS User:
                                <br><br>
                                - Press [Ctrl] + [Shift] + [R] once.
                            </p>
                            <p class="ms-4 text-danger">QUICK TIPS #2</p>
                            <p class="ms-5">
                                For Safari browser:
                                <br><br>
                                - Go to Settings &gt; Safari.
                                <br><br>
                                - Scroll down and select Clear History and Website Data to clear both history and
                                cookies/cache.
                                <br><br>
                                - Re-open the browser after.
                                <br><br><br>
                                For Chrome browser:
                                <br><br>
                                - Select on the three dots (More) at the right side.
                                <br><br>
                                - Select History.
                                <br><br>
                                - Select Clear Browsing Data.
                                <br><br>
                                - Re-open the browser after.
                                <br><br><br>
                                For Edge browser:
                                <br><br>
                                - Select on the three dots (More) at the right side.
                                <br><br>
                                - Select Settings.
                                <br><br>
                                - Search for Clear browsing data now.
                                <br><br>
                                - Select Choose what to clear.
                                <br><br>
                                - Select All time.
                                <br><br>
                                - Check Cookies and other site data &amp; Cached images and files.
                                <br><br>
                                - Select Clear now.
                                <br><br>
                                - Re-open the browser after.
                            </p>
                            <p class="ms-4 text-danger">QUICK TIPS #3</p>
                            <p class="ms-5">
                                You may be using an outdated internet browser, update it by going to settings and search
                                update.
                            </p>
                            <p class="ms-4 text-danger">QUICK TIPS #4</p>
                            <p class="ms-5">
                                You could be experiencing an unexpected bug, you can contact the developer [Jocelyn
                                Compoto].
                            </p>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
