@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('style')
    <style type="text/css">
        .home_nav {
            color: rgb(255, 255, 255, 1.0);
        }

        .line {
            left: -47px;
            position: absolute;
            background-color: #000;
            width: 3px;
            height: 100%;
        }

        .bullet {
            left: -50px;
            position: absolute;
            background-color: #000;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
    </style>
@endsection

@section('title', 'Home')

@section('body')
    <div class="container-fluid">
        <div class="row" style="display: flex; justify-content: right; gap: 0 15px;">

            <div class="col-12 p-3 text-center p-1" style="border-radius: 15px !important;">
                <div class="p-4" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; position: relative;
                    background-color: rgba(255, 255, 255, 0.4);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                    border-radius: 7px;">
                    <div class="bg-danger bg-gradient py-auto"
                         style="position: absolute; top: -22px; left: 25px; margin: 0; padding: 0 10px 0 10px;">
                        <b><h5 class="m-0 p-0 px-1 py-1 text-white">WHAT`S NEW</h5></b>
                    </div>

                    <div class="text-start d-flex flex-column w-75 ps-5">
                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Deployment</b></small>
                            <small class="ms-5">The revised system now utilizes the Laravel framework.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Development</b></small>
                            <small class="ms-5">The system's expense request conversion & revision and sales & purhasing development was initialize on August 12, 2024.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Upgrade</b></small>
                            <small class="ms-5">The system was transfered to a secured server.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Transition</b></small>
                            <small class="ms-5">The system was preparation for server transfer was initialized on August 07, 2024.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Revision</b></small>
                            <small class="ms-5">The system revision was initialized during its development.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Deployment</b></small>
                            <small class="ms-5">The system's user deployment was supervise by Jocelyn Compoto.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Achievement</b></small>
                            <small class="ms-5">The system first request was created on May 17, 2024.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Deployment</b></small>
                            <small class="ms-5">The system was deployed at Infinity Free.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Design</b></small>
                            <small class="ms-5">The system design was supervise by Jocelyn Compoto.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Architecture</b></small>
                            <small class="ms-5">The system utilized the serverless architecture.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Development</b></small>
                            <small class="ms-5">The system development was initialize on April 22, 2024.</small>
                        </div>

                        <div class="d-flex flex-column position-relative justify-content-center py-4">
                            <span class="bullet"></span>
                            <span class="line"></span>
                            <small><b>System Introduction</b></small>
                            <small class="ms-5">The system concept was introduced to the interns on April 22, 2024.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3 text-center p-1" style="border-radius: 15px !important;">
                <div class="p-4" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; position: relative;
                    background-color: rgba(255, 255, 255, 0.4);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                    border-radius: 7px;">
                    <div class="bg-danger bg-gradient py-auto"
                         style="position: absolute; top: -22px; left: 25px; margin: 0; padding: 0 10px 0 10px;">
                        <b><h5 class="m-0 p-0 px-1 py-1 text-white">KEEP ENCOUNTERING ERRORS?</h5></b>
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
