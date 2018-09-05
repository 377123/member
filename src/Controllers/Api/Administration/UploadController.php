<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-04-18 15:49
 */
namespace Notadd\Member\Controllers\Api\Administration;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Member\Handlers\Administration\Upload\UploadHandler;

/**
 * Class UploadController.
 */
class UploadController extends Controller
{
    /**
     * Handle.
     *
     * @param \Notadd\Member\Handlers\Administration\Upload\UploadHandler $handler
     *
     * @return \Notadd\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function handle(UploadHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
