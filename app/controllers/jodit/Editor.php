<?php
/**
 *  fiename: fish/Editor.php$🐘
 *  date:  2024/11/1   14:24$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace  controllers\jodit;
use Albakov\JoditFilebrowser\Handler;
use base\BaseController;

class Editor extends BaseController
{


    public function browser()
    {
        $config = [
            'root' => WEB_PATH.'/files',
            'baseurl' => SITE_URL.'files',
            'sources' => [
                'files' => [
                    'root' => WEB_PATH.'/files',
                    'baseurl' =>SITE_URL.'files',
                    'extensions' => ['jpg', 'jpeg', 'png', 'gif']
                ]
            ]
        ];
        return (new Handler($config))->handle();
    }
}