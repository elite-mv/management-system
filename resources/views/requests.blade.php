@extends('layouts.app')


@section('title', 'My Request')


@section('style')
<link rel="stylesheet" href="style.css">

<style type="text/css">
    .my_request_nav {
        color: rgb(255, 255, 255, 1.0);
    }
    .one-button {
        border: 5px solid #F6C23E;
        color: #F6C23E;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .one-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #F6C23E;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .two-button {
        border: 5px solid #BA16BA;
        color: #BA16BA;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .two-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #BA16BA;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .three-button {
        border: 5px solid #34B3FE;
        color: #34B3FE;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .three-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #34B3FE;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .four-button {
        border: 5px solid #DC3545;
        color: #DC3545;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .four-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #DC3545;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .five-button {
        border: 5px solid #CB6015;
        color: #CB6015;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .five-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #CB6015;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .six-button {
        border: 5px solid #05C3DD;
        color: #05C3DD;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .six-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #05C3DD;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .seven-button {
        border: 5px solid #198754;
        color: #198754;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .seven-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #198754;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .eight-button {
        border: 5px solid #000;
        color: #000;
        border-style: none none none solid; 
        border-radius: 6px; 
        position: relative;
    }
    .eight-button::before {
        content: attr(data-content);
        position: absolute;
        bottom: 0;
        left: -5px;
        width: 0;
        height: 100%;
        background-color: #000;
        border-radius: 6px;
        transition: width 0.4s linear;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        overflow: hidden;
    }
    .one-button:hover::before, .two-button:hover::before, .three-button:hover::before, .four-button:hover::before, .five-button:hover::before, .six-button:hover::before, .seven-button:hover::before, .eight-button:hover::before {
        width: calc(100% + 5px);
    }
</style>
@endsection

@section('body')

<div class="container p-3" style="position: relative;">

    
    <div style="max-width: 200px" class="mb-2 form-group d-flex gap-2 align-items-center">
        <label class="form-label mb-0" for="status">Filter</label>
        <select class="form-control" id="status">
            <option>All</option>
            <option>Pending</option>
            <option>To Return</option>
            <option>Hold</option>
            <option>To Process</option>
            <option>Processing</option>
            <option>For Funding</option>
            <option>Released</option>
        </select>
    </div>

    <div class="row mb-3">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-start">
                            <i class="fas fa-table me-1"></i>
                            <b>My Request</b>
                        </div>
                    </div>
                </div>
                <div class="card-body overflow-x-auto">
                    <table>
                        <thead>
                            <tr>
                                <th>REFERENCE</th>
                                <th>DURATION</th>
                                <th>ENTITY</th>
                                <th>REQUESTED BY</th>
                                <th>STATUS</th>
                                <th>TOTAL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="my_request_database"">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    My Monthly Expenses
                </div>
                <div class="card-body"><canvas id="Area_My" width="100%" height="40"></canvas></div>
                <div class="card-footer small text-muted">Updated today on <?php echo date("g:i A"); ?></div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-start">
                            <i class="fas fa-chart-pie me-1"></i>
                            My Request Status Distribution
                        </div>
                    </div>
                </div>
                <div class="card-body"><canvas id="Request_My_Status_Distribution" width="100%" height="40"></canvas></div>
                <div class="card-footer small text-muted">Updated today on <?php echo date("g:i A"); ?></div>
            </div>
        </div>

    </div>

    <div id="group_message">
        <div id="hidden_group_message" class="h-100 m-0 p-0">
            <button type="button" class="bg-dark text-center text-white py-2 w-100 border-0" id="close_group_message" style="height: 50px;">Group Chat for Everyone</button>

            <div class="w-100" id="chat_box_container" style="height: calc(100% - 100px); transform: scaleY(-1); overflow-x: hidden; overflow-y: auto;">
                <!-- DYNAMIC -->
            </div>

            <form id="comment-form" class="w-100 sticky-bottom m-0" style="height: 50px;">
                <div class="comment-area h-100">
                    <div class="bg-dark h-100" style="display: flex; justify-content: center; align-items: center; flex-direction: row;">
                        <div class="w-100 p-1 m-0">
                            <textarea class="form-control rounded-pill" placeholder="Type your here." rows="1" name="message" required style="resize: none;"></textarea>
                        </div>
                        <div class="w-50 p-1 d-flex align-items-center m-0">
                            <button type="submit" class="btn btn-sm btn-danger py-1 w-100 rounded-pill">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@section('script')
<script type="text/javascript">
    $(window).on('load', function() {
        $(".loader").fadeOut('slow');
        $('#hidden_group_message').hide();
    });

    $('#group_message').css({
        position: 'fixed',
        bottom: '0',
        right: '0',
        width: '75px',
        height: '75px',
        margin: '15px',
        border: '2px solid #000',
        borderRadius: '50%',
        backgroundImage: 'url(src/logos/ELITE_ACES_LOGO.jpg)',
        backgroundSize: 'cover',
        cursor: 'pointer',
        transition: 'width 1.5s, height 1.5s, border-radius 1.5s, background-image 0.5s, background-color 0.5s',
        display: 'flex',
        flexDirection: 'column',
    })

    let Chat_Head = false;

    function get_comment() {
        $.ajax({
            url: "./php/get_group_message.php",
            method: "GET",
            success: function (data) {
                $('#chat_box_container').html(data);
            }
        });
    }

    $('#comment-form').on('submit', function(event) {
        event.preventDefault();
        const message = $('textarea[name="message"]').val();

        $.ajax({
            url: "./php/add_group_message.php",
            method: "POST",
            data: {
                message: message
            },
            success: function (data) {
                $('textarea[name="message"]').val('');
                get_comment();

                $.ajax({
                    url: "./php/send_notification.php",
                    method: "POST",
                    data: {
                        message: data,
                        type: 'group'
                    },
                    success: function (data) {

                    }
                });
            }
        });
    })

    $('#group_message').on('click', function() {
        if (!Chat_Head) {
            $('#group_message').css({
                'max-width': 'calc(100vw - 30px)',
                width: '300px',
                height: '70vh',
                borderRadius: '0',
                backgroundImage: '',
                backgroundColor: '#fff'
            })

            setTimeout(function() {
                $('#hidden_group_message').fadeIn('slow');
                setInterval(get_comment, 1000);
                Chat_Head = true;
            }, 1000);
        } else {
            Chat_Head = false;
        }
    })

    $('#close_group_message').on('click', function() {
        if (Chat_Head) {
            $('#group_message').css({
                width: '75px',
                height: '75px',
                borderRadius: '50%',
                backgroundImage: 'url(src/logos/ELITE_ACES_LOGO.jpg)'
            })
            $('#hidden_group_message').hide();
        }
    })
</script>
<script type="text/javascript" src="./js/my_request.js"></script>
<script type="text/javascript" src="./js/header.js"></script>
@endsection