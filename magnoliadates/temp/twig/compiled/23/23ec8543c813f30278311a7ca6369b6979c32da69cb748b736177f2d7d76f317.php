<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* media_content.twig */
class __TwigTemplate_4a9d5c484a67e2b50b5bc573b890bd0829697afbf342fc7c45e24bcccc916361 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("friendlist"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        $context['is_module_installed'] = $result;
        // line 2
        echo "<div class=\"media-gallery-editor\">
    <div class=\"media-gallery-editor__media-box\">

        ";
        // line 5
        if (($this->getAttribute(($context["media"] ?? null), "upload_gid", []) == "gallery_video")) {
            // line 6
            echo "            ";
            if (($this->getAttribute($this->getAttribute(($context["media"] ?? null), "media_video_data", []), "status", []) == "start")) {
                // line 7
                echo "                <div class=\"pos-rel\">
                    <div class=\"center lh0 pos-rel\">
                        ";
                // line 9
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_media_photo"                ,"media"                ,""                ,"button"                ,($context["media"] ?? null)                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                $context['text_media_photo'] = $result;
                // line 10
                echo "                        <img data-image-src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["media"] ?? null), "video_content", []), "thumbs", []), "grand", []);
                echo "\"
                             src=\"";
                // line 11
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["media"] ?? null), "video_content", []), "thumbs", []), "grand", []);
                echo "\"
                             alt=\"";
                // line 12
                echo ($context["text_media_photo"] ?? null);
                echo "\" title=\"";
                echo ($context["text_media_photo"] ?? null);
                echo "\" class=\"img-responsive\">
                        <div id=\"next_media\" class=\"fas fa-angle-right load_content_right media_view_scroller_right\"></div>
                        <div id=\"prev_media\" class=\"fas fa-angle-left load_content_left media_view_scroller_left\"></div>
                    </div>
                    <div class=\"subinfo box-sizing ";
                // line 16
                if (($context["is_user_media_owner"] ?? null)) {
                    echo " center ";
                }
                echo "\">
                        <p>
                            ";
                // line 18
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("video_wait_converting"                ,"media"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 19
                echo "                        </p>
                        ";
                // line 20
                if (($this->getAttribute(($context["media"] ?? null), "id_parent", []) ||  !($context["is_user_media_owner"] ?? null))) {
                    // line 21
                    echo "                            ";
                    if ($this->getAttribute(($context["media"] ?? null), "id_parent", [])) {
                        // line 22
                        echo "                                ";
                        if (($this->getAttribute(($context["media"] ?? null), "permissions", []) == 0)) {
                            // line 23
                            echo "                                    <p>
                                        ";
                            // line 24
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("permissions_restrict"                            ,"media"                            ,                            );
                            @ob_start();
                            $ci = &get_instance();
                            $ci->load->helper($helper, $module);
                            if (empty($module)) {
                            $module = str_replace('_helper', '', $helper);
                            }
                            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                            } elseif (function_exists($name)) {
                            $result = call_user_func_array($name, $params);
                            } else {
                            $result = '';
                            }
                            $output_buffer = @ob_get_contents();
                            @ob_end_clean();
                            echo $output_buffer.$result;
                            // line 25
                            echo "                                    </p>
                                ";
                        }
                        // line 27
                        echo "                                ";
                        if (($this->getAttribute(($context["media"] ?? null), "video_content", []) &&  !$this->getAttribute(($context["media"] ?? null), "media_video", []))) {
                            // line 28
                            echo "                                    <p>
                                        ";
                            // line 29
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("media_deleted_by_owner"                            ,"media"                            ,                            );
                            @ob_start();
                            $ci = &get_instance();
                            $ci->load->helper($helper, $module);
                            if (empty($module)) {
                            $module = str_replace('_helper', '', $helper);
                            }
                            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                            } elseif (function_exists($name)) {
                            $result = call_user_func_array($name, $params);
                            } else {
                            $result = '';
                            }
                            $output_buffer = @ob_get_contents();
                            @ob_end_clean();
                            echo $output_buffer.$result;
                            // line 30
                            echo "                                    </p>
                                ";
                        }
                        // line 32
                        echo "                            ";
                    }
                    // line 33
                    echo "                            <span>
                                ";
                    // line 34
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("media_owner"                    ,"media"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo ":&nbsp;
                                ";
                    // line 35
                    if ($this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "id", [])) {
                        // line 36
                        echo "                                    <a href=\"";
                        $module =                         null;
                        $helper =                         'seo';
                        $name =                         'seolink';
                        $params = array("users"                        ,"view"                        ,$this->getAttribute(($context["media"] ?? null), "owner_info", [])                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "\">
                                        ";
                        // line 37
                        echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "output_name", []);
                        echo "
                                    </a>
                                ";
                    } else {
                        // line 40
                        echo "                                    <span>
                                        ";
                        // line 41
                        echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "output_name", []);
                        echo "
                                    </span>
                                ";
                    }
                    // line 44
                    echo "                            </span>
                        ";
                }
                // line 46
                echo "                    </div>
                </div>
            ";
            } else {
                // line 49
                echo "                <div class=\"plr50 pos-rel\">
                    <div style=\"max-width: ";
                // line 50
                echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "video_content", []), "width", []);
                echo "px;\" class=\"center-block\">
                        ";
                // line 51
                echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "video_content", []), "embed", []);
                echo "
                    </div>
                    <div id=\"next_media\" class=\"fas fa-angle-right load_content_right media_view_scroller_right\"></div>
                    <div id=\"prev_media\" class=\"fas fa-angle-left load_content_left media_view_scroller_left\"></div>
                </div>
                ";
                // line 56
                if ( !($context["is_user_media_owner"] ?? null)) {
                    // line 57
                    echo "                    <div>
                        ";
                    // line 58
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("media_owner"                    ,"media"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo ":&nbsp;
                        ";
                    // line 59
                    if ($this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "id", [])) {
                        // line 60
                        echo "                            <a href=\"";
                        $module =                         null;
                        $helper =                         'seo';
                        $name =                         'seolink';
                        $params = array("users"                        ,"view"                        ,$this->getAttribute(($context["media"] ?? null), "owner_info", [])                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "\">
                                ";
                        // line 61
                        echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "output_name", []);
                        echo "
                            </a>
                        ";
                    } else {
                        // line 64
                        echo "                            <span>";
                        echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "output_name", []);
                        echo "</span>
                        ";
                    }
                    // line 66
                    echo "                    </div>
                ";
                }
                // line 68
                echo "            ";
            }
            // line 69
            echo "        ";
        } elseif (($this->getAttribute(($context["media"] ?? null), "upload_gid", []) == "gallery_audio")) {
            // line 70
            echo "
            <div class=\"media-gallery-editor__media-source-box container_\">
                <div data-area=\"view\" class=\"inner-image\">
                    <div id=\"audio_content\" class=\"g-users-gallery__audio audio-content b-audiocell\" data-id-media=\"";
            // line 73
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo "\">

                        <div id=\"timeline_popup\" class=\"timeline list-timeline timeline_";
            // line 75
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo "\">
                            <div id=\"playhead_popup\" class=\"playhead small playhead_";
            // line 76
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo "\"></div>
                            <span id=\"playhead-ball\" class=\"playhead-ball small hide playhead-ball_";
            // line 77
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo "\"></span>
                        </div>

                        <div id=\"play_popup\" class=\"play-track play-track_";
            // line 80
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo " b-audiocell__play\" style=\"hei\">
                            <i class=\"fa fa-play fa-lg\"></i>
                        </div>
                        <div id=\"duration_popup\" class=\"duration_";
            // line 83
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo " duration-time duration-glr b-audiocell__time\"></div>
                        <div class=\"clearfix\"></div>

                        <div id=\"audioname_popup\" class=\"audioname_";
            // line 86
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo " b-audiocell__txt\">
                            ";
            // line 87
            echo $this->getAttribute(($context["media"] ?? null), "fname", []);
            echo "
                        </div>

                        <div class=\"g-users-gallery__overlay-icon\">
                            <i class=\"fa fa-music fa-4x opacity60\"></i>
                        </div>
                        <audio id=\"player_";
            // line 93
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo "\" preload=\"auto\" src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["media"] ?? null), "media", []), "mediafile", []), "file_url", []);
            echo "\"></audio>
                    </div>

                    <div id=\"next_media\" class=\"fas fa-angle-right load_content_right\"></div>
                    <div id=\"prev_media\" class=\"fas fa-angle-left load_content_left\"></div>
                    <div class=\"media-gallery-editor__photo-menu\">
                        <span id=\"media_position\"></span>
                    </div>

                </div>
            </div>
            <div class=\"clr\"></div>
        ";
        } elseif (($this->getAttribute(        // line 105
($context["media"] ?? null), "upload_gid", []) == "gallery_image")) {
            // line 106
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_media_photo"            ,"media"            ,""            ,"button"            ,($context["media"] ?? null)            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            $context['text_media_photo'] = $result;
            // line 107
            echo "
            <div class=\"media-gallery-editor__media-source-box container_\">
                <div class=\"photo-edit hide\" data-area=\"recrop\">
                    <div class=\"source-box\">
                        <div id=\"photo_source_recrop_box\" class=\"media-gallery-editor__media-source photo-source-box\">
                            <img data-image-src=\"";
            // line 112
            echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["media"] ?? null), "media", []), "mediafile", []), "file_url", []);
            echo "\"
                                 src=\"";
            // line 113
            echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["media"] ?? null), "media", []), "mediafile", []), "file_url", []);
            echo "\" id=\"photo_source_recrop\" class=\"img-responsive\"
                                 alt=\"";
            // line 114
            echo ($context["text_media_photo"] ?? null);
            echo "\" title=\"";
            echo ($context["text_media_photo"] ?? null);
            echo "\">
                        </div>
                        <div id=\"recrop_menu\" class=\"media-gallery-editor__photo-menu\">
                            <ul class=\"media-gallery-editor__photo-sizes\" id=\"photo_sizes\"></ul>
                            <ul class=\"media-gallery-editor__photo-view\">
                                <li>
                                    <span data-section=\"view\">
                                        ";
            // line 121
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("view"            ,"media"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 122
            echo "                                    </span>
                                </li>
                            </ul>
                            <ul class=\"media-gallery-editor__photo-rotate\">
                                <li>
                                    <i id=\"photo_mirror_hor\" class=\"fas fa-exchange-alt w fa-2x icon-hover\"></i>
                                </li>
                                <li>
                                    <i id=\"photo_rotate_left\" class=\"fas fa-undo w fa-2x icon-hover\"></i>
                                </li>
                                <li>
                                    <i id=\"photo_rotate_right\" class=\"fas fa-redo w fa-2x icon-hover\"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div data-area=\"view\" class=\"inner-image\">
                    <img data-image-src=\"";
            // line 141
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["media"] ?? null), "media", []), "mediafile", []), "thumbs", []), "grand", []);
            echo "\"
                         src=\"";
            // line 142
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["media"] ?? null), "media", []), "mediafile", []), "thumbs", []), "grand", []);
            echo "\" id=\"photo";
            echo $this->getAttribute(($context["media"] ?? null), "id", []);
            echo "\"
                         alt=\"";
            // line 143
            echo ($context["text_media_photo"] ?? null);
            echo "\" title=\"";
            echo ($context["text_media_photo"] ?? null);
            echo "\" class=\"img-responsive\">
                  ";
            // line 144
            if ((($context["user_type"] ?? null) != "admin")) {
                // line 145
                echo "                    <div id=\"next_media\" class=\"fas fa-angle-right load_content_right\"></div>
                    <div id=\"prev_media\" class=\"fas fa-angle-left load_content_left\"></div>
                    <div class=\"media-gallery-editor__photo-menu\">
                        <span id=\"media_position\"></span>
                    </div>
                     ";
            }
            // line 151
            echo "                </div>

                 ";
            // line 153
            if ((($context["user_type"] ?? null) != "admin")) {
                // line 154
                echo "                ";
                if (($this->getAttribute(($context["media"] ?? null), "id_parent", []) ||  !($context["is_user_media_owner"] ?? null))) {
                    // line 155
                    echo "                    <div class=\"subinfo\">
                        ";
                    // line 156
                    if ($this->getAttribute(($context["media"] ?? null), "id_parent", [])) {
                        // line 157
                        echo "                            ";
                        if (($this->getAttribute(($context["media"] ?? null), "permissions", []) == 0)) {
                            // line 158
                            echo "                                <p>
                                    ";
                            // line 159
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("permissions_restrict"                            ,"media"                            ,                            );
                            @ob_start();
                            $ci = &get_instance();
                            $ci->load->helper($helper, $module);
                            if (empty($module)) {
                            $module = str_replace('_helper', '', $helper);
                            }
                            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                            } elseif (function_exists($name)) {
                            $result = call_user_func_array($name, $params);
                            } else {
                            $result = '';
                            }
                            $output_buffer = @ob_get_contents();
                            @ob_end_clean();
                            echo $output_buffer.$result;
                            // line 160
                            echo "                                </p>
                            ";
                        }
                        // line 162
                        echo "                            ";
                        if (($this->getAttribute(($context["media"] ?? null), "media", []) &&  !$this->getAttribute(($context["media"] ?? null), "mediafile", []))) {
                            // line 163
                            echo "                                <p>
                                    ";
                            // line 164
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("media_deleted_by_owner"                            ,"media"                            ,                            );
                            @ob_start();
                            $ci = &get_instance();
                            $ci->load->helper($helper, $module);
                            if (empty($module)) {
                            $module = str_replace('_helper', '', $helper);
                            }
                            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                            } elseif (function_exists($name)) {
                            $result = call_user_func_array($name, $params);
                            } else {
                            $result = '';
                            }
                            $output_buffer = @ob_get_contents();
                            @ob_end_clean();
                            echo $output_buffer.$result;
                            // line 165
                            echo "                                </p>
                            ";
                        }
                        // line 167
                        echo "                        ";
                    }
                    // line 168
                    echo "                        <div class=\"media-gallery-editor__owner\">
                            ";
                    // line 169
                    if ($this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "id", [])) {
                        // line 170
                        echo "                                <a data-action=\"set_user_ids\" data-gid=\"media\" data-href=\"";
                        $module =                         null;
                        $helper =                         'seo';
                        $name =                         'seolink';
                        $params = array("users"                        ,"view"                        ,$this->getAttribute(($context["media"] ?? null), "owner_info", [])                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "\" href=\"#\">
                                    ";
                        // line 171
                        echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "output_name", []);
                        echo "
                                </a>
                            ";
                    } else {
                        // line 174
                        echo "                                <span>
                                    ";
                        // line 175
                        echo $this->getAttribute($this->getAttribute(($context["media"] ?? null), "owner_info", []), "output_name", []);
                        echo "
                                </span>
                            ";
                    }
                    // line 178
                    echo "                        </div>
                    </div>
                ";
                }
                // line 181
                echo "                  ";
            }
            // line 182
            echo "            </div>

        ";
        }
        // line 185
        echo "
        <div class=\"media-preloader hide\" id=\"media_preloader\"></div>
        <div class=\"media-gallery-editor__media-actions ";
        // line 187
        if ((($context["is_user_media_owner"] ?? null) || (($context["user_type"] ?? null) == "admin"))) {
            echo " hide ";
        }
        echo "\">
            ";
        // line 188
        if ((($context["is_user_media_owner"] ?? null) || (($context["user_type"] ?? null) == "admin"))) {
            // line 189
            echo "
            ";
        } else {
            // line 191
            echo "                <div class=\"media-action-item\">
                    ";
            // line 192
            $module =             null;
            $helper =             'ratings';
            $name =             'send_rating_block';
            $params = array(["object_id" => $this->getAttribute(            // line 193
($context["media"] ?? null), "id", []), "type_gid" => "media_object", "responder_id" =>             // line 195
($context["responder_id"] ?? null), "success" =>             // line 196
($context["rating_callback"] ?? null), "is_owner" =>             // line 197
($context["is_user_media_owner"] ?? null), "template" => "form"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 200
            echo "                </div>

                <div class=\"media-action-item\">
                    ";
            // line 203
            $module =             null;
            $helper =             'likes';
            $name =             'like_block';
            $params = array(["gid" => ("media" . $this->getAttribute(            // line 204
($context["media"] ?? null), "id", [])), "type" => "button", "btn_class" => "edge w", "template" => "popup"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 209
            echo "                </div>

                <div class=\"media-action-item\">
                    ";
            // line 212
            $module =             null;
            $helper =             'spam';
            $name =             'mark_as_spam_block';
            $params = array(["object_id" => $this->getAttribute(            // line 213
($context["media"] ?? null), "id", []), "type_gid" => "media_object", "template" => "whitebutton", "icon_size" => "lg"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 218
            echo "                </div>
            ";
        }
        // line 220
        echo "        </div>

    </div>
</div>

<div class=\"container\">
    <div class=\"row\">
        ";
        // line 227
        if ((($context["user_type"] ?? null) != "admin")) {
            // line 228
            echo "        <div class=\"col-xs-12 col-sm-12 col-md-8 col-lg-8\">
            <div class=\"media-popup-info\">
                ";
            // line 230
            if (($this->getAttribute(($context["media"] ?? null), "upload_gid", []) == "gallery_audio")) {
                // line 231
                echo "                        ";
                if (($context["is_user_media_owner"] ?? null)) {
                    // line 232
                    echo "                                <label class=\"media-label-editable\">
                                    ";
                    // line 233
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("label_edit_title"                    ,"audio_uploads"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo " :
                                </label>

                                <div class=\"form-group\">
                                    <input contenteditable class=\"form-control audio_content\"
                                        value=\"";
                    // line 238
                    if ($this->getAttribute(($context["media"] ?? null), "fname", [])) {
                        echo nl2br(twig_escape_filter($this->env, $this->getAttribute(($context["media"] ?? null), "fname", []), "html", null, true));
                    }
                    echo "\">
                                </div>

                                <label class=\"media-label-editable\">
                                    ";
                    // line 242
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("label_edit_lyrics"                    ,"audio_uploads"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo ":
                                </label>

                                <div class=\"text form-group song_lyrics\">
                                    <textarea contenteditable class=\"form-control song_lyrics\" value=\"\">";
                    // line 246
                    if ($this->getAttribute(($context["media"] ?? null), "description", [])) {
                        echo $this->getAttribute(($context["media"] ?? null), "description", []);
                    }
                    echo "</textarea>
                                </div>

                        ";
                } else {
                    // line 250
                    echo "                                ";
                    if ($this->getAttribute(($context["media"] ?? null), "fname", [])) {
                        // line 251
                        echo "                                        <div>";
                        echo nl2br(twig_escape_filter($this->env, $this->getAttribute(($context["media"] ?? null), "fname", []), "html", null, true));
                        echo "</div>
                                ";
                    }
                    // line 253
                    echo "                        ";
                }
                // line 254
                echo "                ";
            } else {
                // line 255
                echo "                    ";
                if (($context["is_user_media_owner"] ?? null)) {
                    // line 256
                    echo "                        <input contenteditable=\"true\" class=\"form-control\" placeholder=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("edit_description"                    ,"media"                    ,""                    ,"button"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "\" name=\"description\" value=\"";
                    if ($this->getAttribute(($context["media"] ?? null), "description", [])) {
                        echo nl2br(twig_escape_filter($this->env, $this->getAttribute(($context["media"] ?? null), "description", []), "html", null, true));
                    }
                    echo "\">
                    ";
                } else {
                    // line 258
                    echo "                        <div class=\"form-group\">";
                    if ($this->getAttribute(($context["media"] ?? null), "description", [])) {
                        echo nl2br(twig_escape_filter($this->env, $this->getAttribute(($context["media"] ?? null), "description", []), "html", null, true));
                    }
                    echo "</div>
                    ";
                }
                // line 260
                echo "                ";
            }
            // line 261
            echo "                <div data-section=\"comments\">
                    ";
            // line 262
            $module =             null;
            $helper =             'comments';
            $name =             'comments_form';
            $params = array(["gid" => "media", "id_obj" => $this->getAttribute(            // line 264
($context["media"] ?? null), "id", []), "hidden" => 0, "max_height" => 500, "view" => "popup", "order_by" => "asc"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 270
            echo "                </div>
                <div data-section=\"albums\" class=\"hide\"></div>
            </div>
        </div>
    ";
        }
        // line 275
        echo "        <div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">
            ";
        // line 276
        if ((($context["is_user_media_owner"] ?? null) || (($context["user_type"] ?? null) == "admin"))) {
            // line 277
            echo "            <div class=\"media-popup-options\" id=\"media_menu\">
                ";
            // line 278
            if ((($context["user_type"] ?? null) != "admin")) {
                // line 279
                echo "                <div class=\"clearfix mb10\">
                    <div class=\"popup-opt-title\">
                        ";
                // line 281
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("albums"                ,"media"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 282
                echo "                    </div>
                    <div class=\"popup-opt-block\">
                        <div data-section=\"albums\">
                            ";
                // line 285
                $module =                 null;
                $helper =                 'media';
                $name =                 'get_albums_for_media';
                $params = array(["id" => $this->getAttribute(                // line 286
($context["media"] ?? null), "id", []), "user_id" =>                 // line 287
($context["user_id"] ?? null), "section" => "albums"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 290
                echo "                        </div>
                    </div>
                </div>
                ";
            }
            // line 294
            echo "                ";
            if (((($context["is_user_media_owner"] ?? null) && ($this->getAttribute(($context["media"] ?? null), "upload_gid", []) == "gallery_image")) || (($context["user_type"] ?? null) == "admin"))) {
                // line 295
                echo "                <div class=\"clearfix mb10\">
                    <div class=\"popup-opt-title\">
                        ";
                // line 297
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_edit"                ,"media"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 298
                echo "                    </div>
                    <div class=\"popup-opt-block\">
                        <button type=\"button\" class=\"btn btn-default\" data-section=\"recrop\">
                            <i class=\"fa fa-crop\"></i> ";
                // line 301
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("recrop"                ,"media"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 302
                echo "                        </button>

                        ";
                // line 304
                ob_start(function () { return ''; });
                // line 305
                echo "                            \$('#photo";
                echo $this->getAttribute(($context["media"] ?? null), "id", []);
                echo "').prop('src')
                        ";
                $context["aviary_photo_source"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 307
                echo "
                        ";
                // line 308
                ob_start(function () { return ''; });
                // line 309
                echo "                            function(imageID, newURL){
                                var error_obj = new Errors();
                                error_obj.show_error_block('";
                // line 311
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("image_update_success"                ,"media"                ,""                ,"js"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "', 'success');

                                var img = document.getElementById(imageID);
                                img.src = newURL;

                                var photo_source = \$('#photo";
                // line 316
                echo $this->getAttribute(($context["media"] ?? null), "id", []);
                echo "');
                                photo_source.prop({src: newURL+'?'+(new Date().getTime())});
                            }
                        ";
                $context["aviary_save_callback"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 320
                echo "
                        ";
                // line 321
                ob_start(function () { return ''; });
                // line 322
                echo "                            ";
                $module =                 null;
                $helper =                 'aviary';
                $name =                 'aviary_editor_button';
                $params = array(["id" => ("photo" . $this->getAttribute(                // line 323
($context["media"] ?? null), "id", [])), "source" =>                 // line 324
($context["aviary_photo_source"] ?? null), "module_gid" => "media", "post_data" =>                 // line 326
($context["aviary_post_data"] ?? null), "save_callback" =>                 // line 327
($context["aviary_save_callback"] ?? null)]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 329
                echo "                        ";
                $context["aviary_editor_button"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 330
                echo "
                        ";
                // line 331
                if (($context["aviary_editor_button"] ?? null)) {
                    // line 332
                    echo "                            <span data-section=\"aviary\">
                                ";
                    // line 333
                    echo ($context["aviary_editor_button"] ?? null);
                    echo "
                            </span>
                        ";
                }
                // line 336
                echo "                    </div>
                </div>
                ";
            }
            // line 339
            echo "                ";
            if ((($context["user_type"] ?? null) != "admin")) {
                // line 340
                echo "                <div class=\"clearfix mb10\">
                    <div class=\"popup-opt-title\">";
                // line 341
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_permitted_for"                ,"media"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</div>
                    <div class=\"popup-opt-block\">
                        <div data-section=\"access\" class=\"\">
                            ";
                // line 344
                if ( !($context["is_user_media_owner"] ?? null)) {
                    // line 345
                    echo "                                <div class=\"h3 error-text\">
                                    ";
                    // line 346
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("only_owner_access"                    ,"media"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 347
                    echo "                                </div>
                            ";
                }
                // line 349
                echo "
                            ";
                // line 350
                $module =                 null;
                $helper =                 'lang';
                $name =                 'ld';
                $params = array("permissions"                ,"media"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                $context['ld_permissions'] = $result;
                // line 351
                echo "                            <select class=\"form-control input-sm mb10\" name=\"permissions\" id=\"permissions\">
                                ";
                // line 352
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["ld_permissions"] ?? null), "option", []));
                foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                    // line 353
                    echo "                                ";
                    if ((twig_test_empty($this->getAttribute(($context["is_module_installed"] ?? null), "friendlist", [])) && ($context["key"] == 2))) {
                    } else {
                        // line 354
                        echo "                                    <option value=\"";
                        echo $context["key"];
                        echo "\" ";
                        if ( !($context["is_user_media_owner"] ?? null)) {
                            echo "disabled";
                        }
                        echo " ";
                        if (($this->getAttribute(($context["media"] ?? null), "permissions", []) == $context["key"])) {
                            echo "selected";
                        }
                        echo ">
                                        ";
                        // line 355
                        echo $context["item"];
                        echo "
                                    </option>

                                ";
                    }
                    // line 359
                    echo "                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 360
                echo "                            </select>
                            ";
                // line 361
                if (($context["is_user_media_owner"] ?? null)) {
                    // line 362
                    echo "                                <input type=\"button\" name=\"save_permissions\" class=\"btn btn-primary\" id=\"save_permissions\" value=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_apply"                    ,"start"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "\">
                            ";
                }
                // line 364
                echo "                        </div>
                    </div>
                </div>
                   ";
            }
            // line 368
            echo "            </div>
            ";
        } else {
            // line 370
            echo "            <div class=\"media-popup-options\" id=\"media_menu\">
                <div class=\"clearfix mb10\">
                    <input type=\"button\" data-id=\"";
            // line 372
            echo $this->getAttribute(($context["default_album"] ?? null), "id", []);
            echo "\" class=\"to_favorites btn btn-primary";
            if (($context["in_favorites"] ?? null)) {
                echo " active";
            }
            echo "\" value=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("add_to_favorites"            ,"media"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "\">
                </div>
                <div class=\"clearfix mb10\">
                    <div class=\"popup-opt-title\">
                        ";
            // line 376
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("albums"            ,"media"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 377
            echo "                    </div>
                    <div class=\"popup-opt-block\">
                        <div data-section=\"albums\">
                            ";
            // line 380
            $module =             null;
            $helper =             'media';
            $name =             'get_albums_for_media';
            $params = array(["id" => $this->getAttribute(            // line 381
($context["media"] ?? null), "id", []), "user_id" =>             // line 382
($context["user_id"] ?? null), "section" => "albums"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 385
            echo "                        </div>
                    </div>
                </div>
            </div>
            ";
        }
        // line 390
        echo "        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "media_content.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1464 => 390,  1457 => 385,  1439 => 382,  1438 => 381,  1434 => 380,  1429 => 377,  1408 => 376,  1376 => 372,  1372 => 370,  1368 => 368,  1362 => 364,  1337 => 362,  1335 => 361,  1332 => 360,  1326 => 359,  1319 => 355,  1306 => 354,  1302 => 353,  1298 => 352,  1295 => 351,  1274 => 350,  1271 => 349,  1267 => 347,  1246 => 346,  1243 => 345,  1241 => 344,  1216 => 341,  1213 => 340,  1210 => 339,  1205 => 336,  1199 => 333,  1196 => 332,  1194 => 331,  1191 => 330,  1188 => 329,  1170 => 327,  1169 => 326,  1168 => 324,  1167 => 323,  1162 => 322,  1160 => 321,  1157 => 320,  1150 => 316,  1123 => 311,  1119 => 309,  1117 => 308,  1114 => 307,  1108 => 305,  1106 => 304,  1102 => 302,  1081 => 301,  1076 => 298,  1055 => 297,  1051 => 295,  1048 => 294,  1042 => 290,  1024 => 287,  1023 => 286,  1019 => 285,  1014 => 282,  993 => 281,  989 => 279,  987 => 278,  984 => 277,  982 => 276,  979 => 275,  972 => 270,  954 => 264,  950 => 262,  947 => 261,  944 => 260,  936 => 258,  907 => 256,  904 => 255,  901 => 254,  898 => 253,  892 => 251,  889 => 250,  880 => 246,  854 => 242,  845 => 238,  818 => 233,  815 => 232,  812 => 231,  810 => 230,  806 => 228,  804 => 227,  795 => 220,  791 => 218,  773 => 213,  769 => 212,  764 => 209,  746 => 204,  742 => 203,  737 => 200,  719 => 197,  718 => 196,  717 => 195,  716 => 193,  712 => 192,  709 => 191,  705 => 189,  703 => 188,  697 => 187,  693 => 185,  688 => 182,  685 => 181,  680 => 178,  674 => 175,  671 => 174,  665 => 171,  641 => 170,  639 => 169,  636 => 168,  633 => 167,  629 => 165,  608 => 164,  605 => 163,  602 => 162,  598 => 160,  577 => 159,  574 => 158,  571 => 157,  569 => 156,  566 => 155,  563 => 154,  561 => 153,  557 => 151,  549 => 145,  547 => 144,  541 => 143,  535 => 142,  531 => 141,  510 => 122,  489 => 121,  477 => 114,  473 => 113,  469 => 112,  462 => 107,  440 => 106,  438 => 105,  421 => 93,  412 => 87,  408 => 86,  402 => 83,  396 => 80,  390 => 77,  386 => 76,  382 => 75,  377 => 73,  372 => 70,  369 => 69,  366 => 68,  362 => 66,  356 => 64,  350 => 61,  326 => 60,  324 => 59,  301 => 58,  298 => 57,  296 => 56,  288 => 51,  284 => 50,  281 => 49,  276 => 46,  272 => 44,  266 => 41,  263 => 40,  257 => 37,  233 => 36,  231 => 35,  208 => 34,  205 => 33,  202 => 32,  198 => 30,  177 => 29,  174 => 28,  171 => 27,  167 => 25,  146 => 24,  143 => 23,  140 => 22,  137 => 21,  135 => 20,  132 => 19,  111 => 18,  104 => 16,  95 => 12,  91 => 11,  86 => 10,  65 => 9,  61 => 7,  58 => 6,  56 => 5,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "media_content.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/media_content.twig");
    }
}
