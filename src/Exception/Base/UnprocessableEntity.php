<?php

namespace App\Exception\Base;

class UnprocessableEntity extends HttpException
{
    const MESSAGE = "Unprocessable Entity";
    const CODE = 422;
}
