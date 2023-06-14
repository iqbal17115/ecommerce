<?php

namespace App\Services;

use App\Models\FrontEnd\Reply;
use Illuminate\Database\Eloquent\Collection;

class ReplyService
{
    /**
     * Store Reply
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function storeReply(array $data)
    {
        //Add Product
        $content = Reply::create($data);
        return $content;
    }
}
