<?php

namespace App\Enums;

enum RequestCommentType: string {
    case TEXT = 'text';
    case FILE = 'file';
    case IMG = 'image';
    case URL = 'url';

    /**
     * @throws \Exception
     */
    public static function valueOf(string $target): RequestCommentType
    {

        foreach (RequestCommentType::cases() as $case) {
            if ($case->value == $target || $case->name == $target) {
                return $case;
            }
        }

        throw new \Exception("Request status not found");
    }
}
