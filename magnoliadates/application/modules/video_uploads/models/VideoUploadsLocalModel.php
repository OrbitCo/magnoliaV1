<?php

declare(strict_types=1);

namespace Pg\modules\video_uploads\models;

/**
 * Video uploads local processing model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class VideoUploadsLocalModel extends \Model
{
    private $slide_count = 3;

    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model('video_uploads/models/Video_uploads_settings_model');
    }

    ///// methods for proccess model
    public function processingMethod($file_name, $file_path, $file_data, $settings)
    {
        $return = ["errors" => [], "data" => []];

        $convert_type = $this->ci->Video_uploads_settings_model->getSettings('local_converting_video_type');
        if (!empty($convert_type)) {
            if ($convert_type == 'ffmpeg') {
                $return_video = $this->ffmpegConvert($file_name, $file_path, $settings["local_settings"]);
            }

            if ($convert_type == 'mencoder') {
                $return_video = $this->mencoderConvert($file_name, $file_path, $settings["local_settings"]);
            }

            if (empty($return_video["errors"]) && !empty($return_video["data"]["video"])) {
                $return["data"]["video"] = $return_video["data"]["video"];
                $return['data']['isHTML5'] = $return_video["data"]["isHTML5"] ?? 0;
                if ($this->ci->Video_uploads_settings_model->get_settings('use_local_converting_meta_data')) {
                    $this->flvtool2MetaTags($return["data"]["video"], $file_path);
                }

                if ($settings["use_thumbs"]) {
                    if ($convert_type == 'ffmpeg') {
                        $return_image = $this->ffmpegGetScreen($file_name, $file_path);
                    }

                    if ($convert_type == 'mencoder') {
                        $return_image = $this->mencoderGetScreen($file_name, $file_path);
                    }

                    if (!empty($return_image["data"]["image"])) {
                        $return["data"]["image"] = $return_image["data"]["image"];
                    }
                }
            } else {
                $return["errors"] = $return_video["errors"];
            }

            $path_parts = pathinfo($file_name);
            $extension = $path_parts["extension"];
            if ($extension != 'flv') {
                $this->deleteFile($file_name, $file_path);
            }
        } else {
            $return["errors"][] = "video converting is disabled";
        }

        return $return;
    }

    public function imagesMethod($file_name, $file_path, $config)
    {
        $convert_type = $this->ci->Video_uploads_settings_model->get_settings('local_converting_video_type');
        if ($convert_type == 'ffmpeg') {
            $return = $this->ffmpegGetScreen($file_name, $file_path);
        }

        if ($convert_type == 'mencoder') {
            $return = $this->mencoderGetScreen($file_name, $file_path);
        }

        return $return;
    }

    public function waitingMethod($file_name, $file_path)
    {
        return true;
    }

    private function mencoderConvert($file_name, $file_path, $config)
    {
        $return = ['errors' => [], 'data' => []];
        $input_file = $file_path . $file_name;

        $path_parts = pathinfo($file_name);
        $extension = $path_parts["extension"];
        $new_file_name = $path_parts["filename"] . ".flv";
        $output_file = $file_path . $new_file_name;

        $mencoder_path = $this->ci->Video_uploads_settings_model->get_settings('mencoder_path');

        $command = $mencoder_path . ' ' . $input_file . ' -o "' . $output_file . '" -ovc lavc -lavcopts vcodec=flv:keyint=50:vbitrate=' . intval($config["video_brate"]) . ':mbd=2:mv0:trell:v4mv:cbp:last_pred=3 -vf scale=' . $config["width"] . ":" . $config["height"] . ' -of lavf -oac mp3lame -lameopts abr:br=' . intval($config["audio_brate"]) . ' -srate ' . intval($config["audio_freq"]) . '';

        shell_exec($command);

        $success_convert = false;
        if (file_exists($output_file)) {
            @chmod($output_file, 0777);
            $file_stat = stat($output_file);
            if ($file_stat["size"] > 0) {
                $success_convert = true;
            }
        }

        if ($success_convert) {
            $return["data"]["video"] = $new_file_name;
            $return["data"]['isHTML5'] = 0;
        } else {
            $return["errors"][] = "error: mencoder can't convert a file";
        }

        return $return;
    }

    /**
     * Convert video file by ffmpeg
     *
     * @param string $file_name video file name
     * @param string $file_path path to video file
     * @param array $config    converting settings
     *
     * @return array
     */
    protected function ffmpegConvert(string $file_name, string $file_path, array $config): array
    {
        $return = ['errors' => [], 'data' => []];
        $input_file = $file_path . $file_name;

        $path_parts = pathinfo($file_name);
        $extension = $path_parts["extension"];

        $size = '';// " -s " . $config["width"] . "x" . $config["height"];

        $ffmpeg_path = $this->ci->Video_uploads_settings_model->getSettings('ffmpeg_path');

        if ($extension != 'flv') {
            $new_file_name = $path_parts["filename"] . ".flv";
            $output_file = $file_path . $new_file_name;

            $command = $ffmpeg_path . " -i " . $input_file . $size . " -ar " . $config["audio_freq"] . " -ab " . $config["audio_brate"] . " -f flv -b " . $config["video_brate"] . " -r " . $config["video_rate"] . " -mbd 2 -y " . $output_file;
            shell_exec($command);

            $success_convert = false;
            if (file_exists($output_file)) {
                @chmod($output_file, 0777);
                $file_stat = stat($output_file);
                if ($file_stat["size"] > 0) {
                    $success_convert = true;
                }
            }
        } else {
            $success_convert = true;
        }

        $success_html5_convert = false;
        if ($extension != 'mp4') {
            if (file_exists($file_path . $path_parts["filename"] . ".flv")) {
                $new_file_name = $path_parts["filename"] . ".mp4";
                $output_file = $file_path . $new_file_name;

                $command = $ffmpeg_path . " -i " . $file_path . $path_parts["filename"] . ".flv " . $size . " -ar " . $config["audio_freq"] . " -ab " . $config["audio_brate"] . " -b " . $config["video_brate"] . " -r " . $config["video_rate"] . " -mbd 2 -y " . $output_file;
                shell_exec($command);

                if (file_exists($output_file)) {
                    @chmod($output_file, 0777);
                    $file_stat = stat($output_file);
                    if ($file_stat["size"] > 0) {
                        $success_html5_convert = true;
                    }
                }
            }
        } else {
            $success_html5_convert = true;
        }

        if ($extension != 'webm') {
            if (file_exists($file_path . $path_parts["filename"] . ".flv")) {
                $new_file_name = $path_parts["filename"] . ".webm";
                $output_file = $file_path . $new_file_name;
                $command = $ffmpeg_path . " -i " . $file_path . $path_parts["filename"] . ".flv" . $size . " -ar " . $config["audio_freq"] . " -ab " . $config["audio_brate"] . " -b " . $config["video_brate"] . " -r " . $config["video_rate"] . " -mbd 2 -y " . $output_file;
                shell_exec($command);

                if (file_exists($output_file)) {
                    @chmod($output_file, 0777);
                    $file_stat = stat($output_file);
                    if ($file_stat["size"] > 0) {
                        $success_html5_convert = true;
                    }
                }
            }
        } else {
            $success_html5_convert = true;
        }

        if ($extension != 'ogg') {
            if (file_exists($file_path . $path_parts["filename"] . ".flv")) {
                $new_file_name = $path_parts["filename"] . ".ogg";
                $output_file = $file_path . $new_file_name;
                $command = $ffmpeg_path . " -i " . $file_path . $path_parts["filename"] . ".flv" . $size . " -ar " . $config["audio_freq"] . " -ab " . $config["audio_brate"] . " -b " . $config["video_brate"] . " -r " . $config["video_rate"] . " -mbd 2 -y " . $output_file;
                shell_exec($command);

                if (file_exists($output_file)) {
                    @chmod($output_file, 0777);
                    $file_stat = stat($output_file);
                    if ($file_stat["size"] > 0) {
                        $success_html5_convert = true;
                    }
                }
            }
        } else {
            $success_html5_convert = true;
        }

        if ($success_convert) {
            $return["data"]["video"] = $path_parts["filename"] . '.flv';
            $return["data"]['isHTML5'] = $success_html5_convert ? 1 : 0;
        } else {
            $return["errors"][] = "error: ffmpeg can't convert a file";
        }

        return $return;
    }

    private function flvtool2MetaTags($file_name, $file_path)
    {
        $return = ['errors' => [], 'data' => []];
        $input_file = $file_path . $file_name;
        $flvtool_path = $this->ci->Video_uploads_settings_model->get_settings('flvtool2_path');
        $command = $flvtool_path . " -UP " . $input_file;
        $ret = shell_exec($command);

        $return["data"]["video"] = $file_name;

        return $return;
    }

    private function ffmpegGetDuration($file_name, $file_path)
    {
        $input_file = $file_path . $file_name;
        $ffmpeg_path = $this->ci->Video_uploads_settings_model->get_settings('ffmpeg_path');
        $command = $ffmpeg_path . " -i " . $input_file . " 2>&1";
        $return = shell_exec($command);

        if (!empty($return) && preg_match('/Duration: ([0-9]+):([0-9]+):([0-9]+)/i', $return, $matches)) {
            $return = 60 * 60 * intval($matches[1]) + 60 * intval($matches[2]) + intval($matches[3]);
        } else {
            $return = 0;
        }

        return $return;
    }

    private function mencoderGetDuration($file_name, $file_path)
    {
        $input_file = $file_path . $file_name;
        $mencoder_path = $this->ci->Video_uploads_settings_model->get_settings('mencoder_path');
        $command = $mencoder_path . " " . $input_file . " -oac copy -ovc copy -o /dev/null";
        $return = shell_exec($command);

        if (!empty($return) && preg_match('/Video stream:.*bytes  ([0-9\.]+) secs/i', $return, $matches)) {
            $return = round($matches[1]);
        } else {
            $return = 0;
        }

        return $return;
    }

    private function ffmpegGetScreen($file_name, $file_path)
    {
        $return = ['errors' => [], 'data' => []];
        $duration = $this->ffmpegGetDuration($file_name, $file_path);
        if ($duration == 0) {
            $start = 10;
        } else {
            $start = (int) floor($duration / 3);
        }
        $date = new \DateTime('2001-01-01');
        $date->setTime(0, 0, $start);
        $start_time = $date->format('H:i:s');

        $input_file = $file_path . $file_name;
        $output_image_name = $this->getScreenName($file_name);
        $output_image = $file_path . $output_image_name;

        $ffmpeg_path = $this->ci->Video_uploads_settings_model->get_settings('ffmpeg_path');
        $command = $ffmpeg_path . " -i " . $input_file . " -an -ss " . $start_time . " -r 1 -vframes 1 -y -f mjpeg " . $output_image . " 2>&1";
        shell_exec($command);

        $success_screen = false;
        if (file_exists($output_image)) {
            @chmod($output_image, 0777);
            $image_stat = stat($output_image);
            if ($image_stat["size"] > 0) {
                $success_screen = true;
            }
        }

        if ($success_screen) {
            $return["data"]["image"] = $output_image_name;
        } else {
            $return["errors"][] = "error: ffmpeg can't create a screen";
        }

        return $return;
    }

    private function mencoderGetScreen($file_name, $file_path)
    {
        $return = ['errors' => [], 'data' => []];
        $duration = $this->mencoderGetDuration($file_name, $file_path);
        if ($duration == 0) {
            $start = 10;
        } else {
            $start = floor($duration / 3);
        }

        $input_file = $file_path . $file_name;
        $mplayer_image = '00000001.jpg';
        $output_image_name = $this->getScreenName($file_name);
        $output_image = $file_path . $output_image_name;

        $mplayer_path = $this->ci->Video_uploads_settings_model->get_settings('mplayer_path');
        $command = $mplayer_path . " -ss " . $start . " -frames 1 -vo jpeg:outdir=" . $file_path . " -nosound " . $input_file;
        shell_exec($command);

        if (file_exists($file_path . $mplayer_image)) {
            @copy($file_path . $mplayer_image, $output_image);
            @unlink($file_path . $mplayer_image);
        }

        $success_screen = false;
        if (file_exists($output_image)) {
            @chmod($output_image, 0777);
            $image_stat = stat($output_image);
            if ($image_stat["size"] > 0) {
                $success_screen = true;
            }
        }

        if ($success_screen) {
            $return["data"]["image"] = $output_image_name;
        } else {
            $return["errors"][] = "error: mencoder can't create a screen";
        }

        return $return;
    }

    private function getScreenName($file_name)
    {
        $path_parts = pathinfo($file_name);

        return $path_parts["filename"] . ".jpg";
    }

    private function deleteFile($file_name, $file_path)
    {
        @unlink($file_path . $file_name);
    }

    public function getDefaultEmbed($file_url, $width = 480, $height = 360, $isHTML5 = false)
    {
        if ($isHTML5) {
            $attrs = '';

            if ((new \Detection\MobileDetect())->isMobile()) {
                $attrs = 'style="width: 100%;"';
            } else {
                $attrs .= 'width="' . $width . '" height="' . $height . '" style="margin: 0 auto; max-width: 100%; max-height: 100%;" controls';
            }

            $parse_url = parse_url($file_url);
            $pathinfo = pathinfo($parse_url['path']);

            $arr_type = ['mp4' => 'video/mp4', 'webm' => 'video/webm', 'ogg' => 'video/ogg'];

            $source = '';
            foreach ($arr_type as $ext => $type) {
                $file = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.' . $ext;

                $file = str_replace(site_url(), SITE_PHYSICAL_PATH, $file);

                if (file_exists($file)) {
                    if (filesize($file) > 0) {
                        $source .= '<source src="' . $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.' . $ext . '" type="' . $type . '" />';
                    } else {
                        @unlink($file);
                    }
                }
            }

            $video = '';
            if (!empty($source)) {
                $video = '<video ' . $attrs . '>' . $source . '</video>';

                return trim($video);
            }
            $file = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.flv';
            $file = str_replace(site_url(), SITE_PHYSICAL_PATH, $file);

            if (file_exists($file)) {
                if (filesize($file) > 0) {
                    $file_url = SITE_SERVER . substr($pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.flv', 1);

                    return $this->get_default_embed($file_url, $width, $height, false);
                }
            }
        } else {
            return trim('
                <video controls style="width: 100%; height:' . $height . 'px;">
                <source src="' . $file_url . '">
                </video>');
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_default_embed' => 'getDefaultEmbed',
            'images_method' => 'imagesMethod',
            'processing_method' => 'processingMethod',
            'waiting_method' => 'waitingMethod',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
