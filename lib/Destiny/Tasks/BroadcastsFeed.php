<?php
namespace Destiny\Tasks;

use Destiny\Common\Annotation\Schedule;
use Destiny\Common\Application;
use Destiny\Common\Config;
use Destiny\Common\Cron\TaskInterface;
use Destiny\Common\Images\ImageDownloadUtil;
use Destiny\Twitch\TwitchApiService;

/**
 * @Schedule(frequency=30,period="minute")
 */
class BroadcastsFeed implements TaskInterface {

    /**
     * @return mixed|void
     */
    public function execute() {
        $broadcasts = TwitchApiService::instance ()->getPastBroadcasts ();
        if (! empty ( $broadcasts )){
            foreach ($broadcasts['videos'] as $i=>$video){
                $path = ImageDownloadUtil::download($video['preview']);
                if(!empty($path))
                    $broadcasts['videos'][$i]['preview'] = Config::cdni() . '/' . $path;
            }
            $cache = Application::getNsCache();
            $cache->save ( 'pastbroadcasts', $broadcasts );
        }
    }

}