<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer">

    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/income-navigation.css">

    <script src="/js/income-navigation.js"></script>

    @yield('style')

</head>
<body>



<main class="container-fluid p-0 income-with-nav">

    <nav>
        <div>
            <a href="home.php">
                <small>
                    <i class="fas fa-home me-4"></i>
                    <span class="hidable">
					HOME
				</span>
                </small>
            </a>
        </div>

        <div>
            <a onclick="DD_Nav('DD_SALES_Nav');">
                <small>
                    <i class="fas fa-shopping-cart me-4"></i>
                    <span class="hidable">
					SALES
					<i class="fas fa-chevron-right"></i>
				</span>
                </small>
            </a>
            <div id="DD_SALES_Nav">
                <a href="/income/customer">
                    <small class="ps-4">
                        CUSTOMERS
                    </small>
                </a>
                <a href="quotes.php">
                    <small class="ps-4">
                        QUOTES
                    </small>
                </a>
                <a href="invoices.php">
                    <small class="ps-4">
                        INVOICES
                    </small>
                </a>
                <a href="soa.php">
                    <small class="ps-4">
                        STATEMENT OF ACCOUNT
                    </small>
                </a>
                <a href="contracts.php">
                    <small class="ps-4">
                        CONTRACTS
                    </small>
                </a>
            </div>
        </div>

        <div>
            <a onclick="DD_Nav('DD_PURCHASES_Nav');">
                <small>
                    <i class="fas fa-shopping-bag me-4"></i>
                    <span class="hidable">
					PURCHASES
					<i class="fas fa-chevron-right"></i>
				</span>
                </small>
            </a>
            <div id="DD_PURCHASES_Nav">
                <a href="vendor.php">
                    <small class="ps-4">
                        VENDORS
                    </small>
                </a>
                <a href="pos.php">
                    <small class="ps-4">
                        PURCHASE ORDERS
                    </small>
                </a>
                <a href="jos.php">
                    <small class="ps-4">
                        JOB ORDERS
                    </small>
                </a>
            </div>
        </div>

        <div>
            <a href="reports.php">
                <small>
                    <i class="far fa-chart-bar me-4"></i>
                    <span class="hidable">
					REPORTS
				</span>
                </small>
            </a>
        </div>

        <div class="nav_footer">
            <i onclick="navigation_hideable();" class="fas fa-chevron-left"></i>
        </div>
    </nav>

    <div>
        @yield('bert')
    </div>

    @yield('body')

</main>


@yield('script')


</body>
</html>
