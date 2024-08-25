<?php

namespace App\Enums;

enum UserRole: string{
    case DEVELOPER = "developer";
    case BOOK_KEEPER = "book keeper";
    case ACCOUNTANT = "accountant";
    case FINANCE = "finance";
    case PRESIDENT = "president";
    case AUDITOR = "auditor";
    case STAFF = "staff";
    case USER = "regular";
    case MODERATOR = "moderator";
    case SALES_OFFICER = "sales officer";

}
