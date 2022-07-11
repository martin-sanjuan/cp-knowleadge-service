<?php

namespace App\Exception\Base;

class NotFoundException extends HttpException
{
    const MESSAGE = "Not Found";
    const CODE = 404;
}
