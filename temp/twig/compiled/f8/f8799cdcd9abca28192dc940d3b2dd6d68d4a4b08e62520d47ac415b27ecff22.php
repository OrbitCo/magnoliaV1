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

/* wall_events_media.twig */
class __TwigTemplate_52e0cfbc9a1258758a48a6e55efc5b2d7aec3961eea9035665c6f67202284dc3 extends \Twig\Template
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
        echo "<span class=\"wall-post-date\">";
        $module =         null;
        $helper =         'date_format';
        $name =         'tpl_date_format';
        $params = array($this->getAttribute(($context["event"] ?? null), "date_update", [])        ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])        ,        );
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
        echo "</span>
";
        // line 2
        if (($this->getAttribute(($context["event"] ?? null), "id_poster", []) != ($context["user_id"] ?? null))) {
            // line 3
            echo "    <button id=\"otheractions_";
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "\" type=\"button\" class=\"btn btn-default wall-otheractions\" data-toggle=\"popover\" data-placement=\"bottom\">
        <i class=\"fa fa-ellipsis-h\"></i>
    </button>
    <div class=\"hide\" id=\"otheractions_";
            // line 6
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "_template\" class=\"otheractions_";
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "_content\">
        <ul>
            ";
            // line 8
            if (($this->getAttribute(($context["event"] ?? null), "id_poster", []) != ($context["user_id"] ?? null))) {
                // line 9
                echo "                ";
                $module =                 null;
                $helper =                 'spam';
                $name =                 'mark_as_spam_block';
                $params = array(["object_id" => $this->getAttribute(                // line 10
($context["event"] ?? null), "id", []), "type_gid" => "wall_events_object", "view_type" => "drpdwn_li"]                ,                );
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
                // line 14
                echo "            ";
            }
            // line 15
            echo "        </ul>
    </div>
    <script type=\"text/javascript\">
        \$(function () {
            \$('#otheractions_";
            // line 19
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "').popover({
                html: true,
                content: function () {
                    return \$('#otheractions_";
            // line 22
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "_template').html();
                }
            });
        });
    </script>
";
        }
        // line 28
        echo "
<p>
    ";
        // line 30
        if (($this->getAttribute(($context["event"] ?? null), "event_type_gid", []) == "image_upload")) {
            // line 31
            echo "        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("uploads_new_photos"            ,"media"            ,            );
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
            // line 32
            echo "    ";
        } elseif (($this->getAttribute(($context["event"] ?? null), "event_type_gid", []) == "video_upload")) {
            // line 33
            echo "        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("uploads_new_videos"            ,"media"            ,            );
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
            // line 34
            echo "    ";
        } elseif (($this->getAttribute(($context["event"] ?? null), "event_type_gid", []) == "audio_upload")) {
            // line 35
            echo "        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("uploads_new_audios"            ,"audio_uploads"            ,            );
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
            // line 36
            echo "    ";
        }
        echo " (";
        echo $this->getAttribute(($context["event"] ?? null), "media_count_all", []);
        echo ")
</p>
<div class=\"b-media-gallery\">
    ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["event"] ?? null), "data", []));
        foreach ($context['_seq'] as $context["key"] => $context["edata"]) {
            // line 40
            echo "        ";
            if (($this->getAttribute($context["edata"], "upload_gid", []) == "gallery_audio")) {
                // line 41
                echo "            <div class=\"b-media-gallery__item-audio\">
                <div class=\"audio-content\" data-id-media=\"";
                // line 42
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\">
                    <audio id=\"player_";
                // line 43
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" preload=\"auto\" src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($context["edata"], "media", []), "mediafile", []), "file_url", []);
                echo "\"></audio>
                    <div id=\"play_";
                // line 44
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" class=\"play-track\" ><i class=\"fa fa-play fa-lg\"></i></div>
                    <div id=\"duration_";
                // line 45
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" class=\"duration-time duration_";
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\"></div>
                    <div id=\"audioname_";
                // line 46
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" class=\"audio-name audioname_";
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\">
                        <span ";
                // line 47
                if ( !twig_test_empty($this->getAttribute($context["edata"], "description", []))) {
                    // line 48
                    echo "                            class=\"audio-lyrics-link\" onclick=\"\$('#lyrics";
                    echo $this->getAttribute($context["edata"], "id", []);
                    echo "').toggle();\" ";
                }
                // line 49
                echo "                            >
                            ";
                // line 50
                echo $this->getAttribute($context["edata"], "fname", []);
                echo "
                        </span>
                    </div>
                    <div id=\"timeline_";
                // line 53
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" class=\"timeline timeline_";
                echo $this->getAttribute($context["edata"], "id", []);
                echo " list-timeline timeline-hide\">
                        <div id=\"playhead_";
                // line 54
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" class=\"playhead small hide playhead_";
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\"></div>
                        <span id=\"playhead-ball_";
                // line 55
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" class=\"playhead-ball small playhead-ball_";
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\"></span>
                    </div>
                    <div class=\"audio-song-lyrics-block hide\" id=\"lyrics";
                // line 57
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\">
                        <span>
                            ";
                // line 59
                echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["edata"], "description", []), "html", null, true));
                echo "
                        </span>
                    </div>
                    <script>
                        /*var first_time_play_";
                // line 63
                echo ($context["rand_id"] ?? null);
                echo " = 1;
                         \$('#player_";
                // line 64
                echo $this->getAttribute(($context["item"] ?? null), "id", []);
                echo "').on('play', function(){
                         if(first_time_play_";
                // line 65
                echo $this->getAttribute(($context["item"] ?? null), "id", []);
                echo " == 1){
                         \$.post(site_url + 'audio_uploads/ajax_increment_listenings', {\"audio_id\":{/literal}{\$item.id}{literal}}, function(){
                         var listenings_number_block = \$('span[data-gid=media{/literal}{\$item.id}{literal}] .view_num');
                         listenings_number_block.html(parseInt(listenings_number_block.html()) + 1);

                         });
                         first_time_play_{/literal}{\$item.id}{literal} = 0;
                         }
                         });*/
                    </script>
                </div>
            </div>
        ";
            } else {
                // line 78
                echo "            <div class=\"b-media-gallery__item\">
                <div class=\"user\">
                    <div class=\"b-media-gallery__photo\">
                        <span class=\"g-pic-border g-rounded\" data-user-id=\"";
                // line 81
                echo $this->getAttribute($context["edata"], "id_owner", []);
                echo "\"
                              data-id-media=\"";
                // line 82
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\" data-click=\"view-media\">
                            ";
                // line 83
                if ($this->getAttribute($context["edata"], "video_content", [])) {
                    // line 84
                    echo "                                <div class=\"overlay-icon pointer\">
                                    <i class=\"fa-play-sign w fa-4x opacity60\"></i>
                                </div>
                            ";
                }
                // line 88
                echo "                            <img src=\"";
                ob_start(function () { return ''; });
                // line 89
                echo "                                 ";
                if ($this->getAttribute($context["edata"], "media", [])) {
                    // line 90
                    echo "                                     ";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["edata"], "media", []), "mediafile", []), "thumbs", []), "big", []);
                    echo "
                                 ";
                } elseif ($this->getAttribute(                // line 91
$context["edata"], "video_content", [])) {
                    // line 92
                    echo "                                     ";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($context["edata"], "video_content", []), "thumbs", []), "big", []);
                    echo "
                                 ";
                }
                // line 94
                echo "                                 ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                echo "\"
                                     alt=\"";
                // line 95
                if ($this->getAttribute($context["edata"], "media", [])) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["edata"], "media", []), "mediafile", []), "photo_alt", []));
                }
                echo "\"
                                     title=\"";
                // line 96
                if ($this->getAttribute($context["edata"], "media", [])) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["edata"], "media", []), "mediafile", []), "photo_title", []));
                }
                echo "\" />
                            </span>
                            <div class=\"b-media-gallery__photoinfo\">
                                <div class=\"b-media-gallery__info-icons\">
                                    ";
                // line 100
                if (($this->getAttribute($context["edata"], "id_parent", []) && (($this->getAttribute($context["edata"], "media", []) &&  !$this->getAttribute($context["edata"], "mediafile", [])) || ($this->getAttribute(                // line 101
$context["edata"], "video_content", []) &&  !$this->getAttribute($context["edata"], "media_video", []))))) {
                    // line 102
                    echo "                                    <p>
                                        ";
                    // line 103
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("media_deleted_by_owner"                    ,"media"                    ,                    );
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
                    // line 104
                    echo "                                    </p>
                                    ";
                }
                // line 106
                echo "                                        <div>
                                            <span class=\"mr10_\" data-gid=\"media";
                // line 107
                echo $this->getAttribute($context["edata"], "id", []);
                echo "\">
                                                <i class=\"far fa-eye\">&nbsp;</i>
                                                <span class=\"view_num\">";
                // line 109
                echo $this->getAttribute($context["edata"], "views", []);
                echo "</span>
                                            </span>
                                            <span class=\"mr10_\">
                                                ";
                // line 112
                $module =                 null;
                $helper =                 'likes';
                $name =                 'like_block';
                $params = array(["gid" => ("media" . $this->getAttribute(                // line 113
($context["edata"] ?? null), "id", [])), "type" => "button", "btn_class" => "edge w"]                ,                );
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
                // line 117
                echo "                                            </span>
                                            ";
                // line 118
                if ($this->getAttribute($context["edata"], "is_adult", [])) {
                    // line 119
                    echo "                                                <i class=\"fa-female edge w\">&nbsp;</i>
                                                <span>18+</span>
                                            ";
                }
                // line 122
                echo "                                            ";
                if (($this->getAttribute($context["edata"], "id_user", []) != ($context["user_id"] ?? null))) {
                    // line 123
                    echo "                                                <span class=\"fright\">
                                                    ";
                    // line 124
                    $module =                     null;
                    $helper =                     'spam';
                    $name =                     'mark_as_spam_block';
                    $params = array(["object_id" => $this->getAttribute(                    // line 125
($context["edata"] ?? null), "id", []), "type_gid" => "media_object", "template" => "whitebutton"]                    ,                    );
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
                    // line 129
                    echo "                                                </span>
                                            ";
                }
                // line 131
                echo "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            }
            // line 138
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['edata'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 139
        echo "                        </div>
                        ";
        // line 140
        if ($this->getAttribute(($context["event"] ?? null), "media_count_more", [])) {
            // line 141
            echo "                            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("filter_section_gallery"            ,"media"            ,            );
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
            $context['gallery_section_name'] = $result;
            // line 142
            echo "                            <div class=\"fright righted\">
                                ";
            // line 143
            ob_start(function () { return ''; });
            ob_start(function () { return ''; });
            // line 144
            echo "                                        ";
            if ((($context["user_id"] ?? null) == $this->getAttribute(($context["event"] ?? null), "id_poster", []))) {
                // line 145
                echo "                                            ";
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"profile"                ,["section-code" => "gallery", "section-name" => ($context["gallery_section_name"] ?? null)]                ,                );
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
                // line 146
                echo "                                        ";
            } else {
                // line 147
                echo "                                            ";
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,["section-code" => "gallery", "section-name" => ($context["gallery_section_name"] ?? null), "data" => $this->getAttribute(($context["event"] ?? null), "id_poster", [])]                ,                );
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
                // line 148
                echo "                                        ";
            }
            // line 149
            echo "                                ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            $context["user_gallery_link"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 150
            echo "                                <a class=\"hover-icon\" href=\"";
            echo ($context["user_gallery_link"] ?? null);
            echo "\">
                                    <i class=\"fa fa-arrow-right edge hover\"></i>
                                    <span class=\"ml5\">
                                        ";
            // line 153
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("show_more"            ,"media"            ,            );
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
            echo "&nbsp;(";
            echo $this->getAttribute(($context["event"] ?? null), "media_count_more", []);
            echo ")
                                    </span>
                                </a>
                            </div>
                        ";
        }
        // line 158
        echo "                        <script>
                            \$(function () {
                                if (!window.wall_mediagallery) {
                                    loadScripts(
                                            \"";
        // line 162
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("media"        ,"../views/flatty/js/media.js"        ,"path"        ,        );
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
        echo "\",
                                            function () {
                                                wall_mediagallery = new media({
                                                    siteUrl: site_url,
                                                    gallery_name: 'wall_mediagallery',
                                                    galleryContentPage: 1,
                                                    btnOk: \"";
        // line 168
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_ok"        ,"start"        ,        );
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
        echo "\",
                                                    btnCancel: \"";
        // line 169
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
        echo "\",
                                                    idUser: 0,
                                                    all_loaded: 1,
                                                    lang_delete_confirm: '";
        // line 172
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm"        ,"media"        ,""        ,"js"        ,        );
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
        echo "',
                                                    lang_delete_confirm_album: '";
        // line 173
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm_albums"        ,"media"        ,""        ,"js"        ,        );
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
        echo "',
                                                    galleryContentDiv: 'wall_events',
                                                    post_data: {filter_duplicate: 1},
                                                    load_on_scroll: false,
                                                    direction: 'desc'
                                                });
                                            },
                                            'wall_mediagallery',
                                            {async: false}
                                    );
                                }
                            });
                        </script>
";
    }

    public function getTemplateName()
    {
        return "wall_events_media.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  728 => 173,  705 => 172,  680 => 169,  657 => 168,  629 => 162,  623 => 158,  594 => 153,  587 => 150,  583 => 149,  580 => 148,  558 => 147,  555 => 146,  533 => 145,  530 => 144,  527 => 143,  524 => 142,  502 => 141,  500 => 140,  497 => 139,  491 => 138,  482 => 131,  478 => 129,  460 => 125,  456 => 124,  453 => 123,  450 => 122,  445 => 119,  443 => 118,  440 => 117,  422 => 113,  418 => 112,  412 => 109,  407 => 107,  404 => 106,  400 => 104,  379 => 103,  376 => 102,  374 => 101,  373 => 100,  364 => 96,  358 => 95,  353 => 94,  347 => 92,  345 => 91,  340 => 90,  337 => 89,  334 => 88,  328 => 84,  326 => 83,  322 => 82,  318 => 81,  313 => 78,  297 => 65,  293 => 64,  289 => 63,  282 => 59,  277 => 57,  270 => 55,  264 => 54,  258 => 53,  252 => 50,  249 => 49,  244 => 48,  242 => 47,  236 => 46,  230 => 45,  226 => 44,  220 => 43,  216 => 42,  213 => 41,  210 => 40,  206 => 39,  197 => 36,  175 => 35,  172 => 34,  150 => 33,  147 => 32,  125 => 31,  123 => 30,  119 => 28,  110 => 22,  104 => 19,  98 => 15,  95 => 14,  77 => 10,  72 => 9,  70 => 8,  63 => 6,  56 => 3,  54 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "wall_events_media.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/wall_events_media.twig");
    }
}
