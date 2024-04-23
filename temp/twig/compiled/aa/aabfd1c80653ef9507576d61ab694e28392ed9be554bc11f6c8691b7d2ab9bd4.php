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

/* ajax_user_avatar.twig */
class __TwigTemplate_5490e413ec2498137b00650c6c6ba01ea808da5a97a356ab1104f9fb3a6e1693 extends \Twig\Template
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
        echo "<div class=\"media-gallery-content\" id=\"image_content_avatar\">
    <div class=\"media-gallery-editor\">
        <div class=\"media-gallery-editor__media-box\">

            ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_media_photo"        ,"media"        ,""        ,"button"        ,($context["media"] ?? null)        ,        );
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
        // line 6
        echo "            <div class=\"media-gallery-editor__media-source-box container\">
                <div class=\"photo-edit hide\" data-area=\"recrop\">
                    <div class=\"source-box\">
                        <div id=\"photo_source_recrop_box\" class=\"media-gallery-editor__media-source photo-source-box\">
                            ";
        // line 10
        if ($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "user_logo_moderation", [])) {
            // line 11
            echo "                                <img id=\"photo_source_recrop\" src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "media", []), "user_logo_moderation", []), "file_url", []);
            echo "\"
                                     alt=\"";
            // line 12
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" class=\"img-responsive\">
                            ";
        } else {
            // line 14
            echo "                                <img id=\"photo_source_recrop\" src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "media", []), "user_logo", []), "file_url", []);
            echo "\"
                                     alt=\"";
            // line 15
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" class=\"img-responsive\">
                            ";
        }
        // line 17
        echo "                        </div>
                        <div id=\"recrop_menu\" class=\"media-gallery-editor__photo-menu\">
                            <ul class=\"media-gallery-editor__photo-sizes\" id=\"photo_sizes\"></ul>
                            <ul class=\"media-gallery-editor__photo-view\">
                                <li>
                                    <span data-section=\"view\">
                                        ";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("view"        ,"media"        ,        );
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
        // line 24
        echo "                                    </span>
                                </li>
                            </ul>
                            <ul id=\"rotate-menu\" class=\"media-gallery-editor__photo-rotate\">
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
                    ";
        // line 43
        if ($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "user_logo_moderation", [])) {
            // line 44
            echo "                        <img id=\"photo_source_recrop\" src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "media", []), "user_logo_moderation", []), "thumbs", []), "grand", []);
            echo "\"
                             alt=\"";
            // line 45
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" class=\"img-responsive\">
                    ";
        } else {
            // line 47
            echo "                        <img id=\"photo_source_recrop\" src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "media", []), "user_logo", []), "thumbs", []), "grand", []);
            echo "\"
                             alt=\"";
            // line 48
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, ($context["text_user_logo"] ?? null));
            echo "\" class=\"img-responsive\">
                    ";
        }
        // line 50
        echo "                </div>
            </div>
            <div class=\"media-preloader hide\" id=\"media_preloader\"></div>
        </div>
    </div>

    <div class=\"container\">
        <div class=\"row mb10\">
            ";
        // line 58
        if ((($context["user_type_logo"] ?? null) != "admin")) {
            // line 59
            echo "            <div class=\"col-xs-12 col-sm-12 col-md-8 col-lg-8\">
                <div class=\"media-popup-info\">
                    <div data-section=\"comments\">
                        ";
            // line 62
            $module =             null;
            $helper =             'comments';
            $name =             'comments_form';
            $params = array(["gid" => "user_avatar", "id_obj" => $this->getAttribute($this->getAttribute(            // line 64
($context["avatar_data"] ?? null), "user", []), "id", []), "hidden" => 0, "view" => "popup", "max_height" => 500, "order_by" => "asc", "count" => $this->getAttribute($this->getAttribute(            // line 69
($context["avatar_data"] ?? null), "user", []), "logo_comments_count", [])]            ,            );
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
            // line 71
            echo "                    </div>
                    <div data-section=\"albums\" class=\"hide\"></div>
                </div>
            </div>
            ";
        }
        // line 76
        echo "
            <div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">
                ";
        // line 78
        if (($this->getAttribute(($context["avatar_data"] ?? null), "is_owner", []) || (($context["user_type_logo"] ?? null) == "admin"))) {
            // line 79
            echo "                    <div class=\"media-popup-options\" id=\"media_menu\">
                        <div class=\"clearfix mb10\">
                            <div class=\"popup-opt-title\">
                                ";
            // line 82
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_edit"            ,"media"            ,            );
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
            // line 83
            echo "                            </div>
                            <div class=\"popup-opt-block\">
                                <button type=\"button\" class=\"btn btn-default\" data-section=\"recrop\">
                                    <i class=\"fa fa-crop\"></i> ";
            // line 86
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("recrop"            ,"media"            ,            );
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
            // line 87
            echo "                                </button>
                            </div>
                        </div>
                        ";
            // line 90
            if ((($context["user_type_logo"] ?? null) != "admin")) {
                // line 91
                echo "                        <div class=\"clearfix mb10\">
                            <div class=\"popup-opt-block\">
                                <button type=\"button\" name=\"btn_change_photo\" id=\"btn_change_photo\" class=\"btn btn-primary\">
                                    ";
                // line 94
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("wc_btn_change_photo"                ,"users"                ,                );
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
                // line 95
                echo "                                </button>
                            </div>
                        </div>
                        ";
            }
            // line 99
            echo "                    </div>

                ";
        }
        // line 102
        echo "            </div>
        </div>
    </div>
</div>



<div class=\"content-block load_content\">
    <div class=\"media-photo-editor\">
        ";
        // line 111
        if ($this->getAttribute(($context["avatar_data"] ?? null), "is_owner", [])) {
            // line 112
            echo "            <link rel=\"stylesheet\" type=\"text/css\" href=\"";
            echo ($context["site_url"] ?? null);
            echo ($context["js_folder"] ?? null);
            echo "jquery.imgareaselect/css/imgareaselect-default.css\"></link>
            <div id=\"avatar_owner_content\">
                <form id=\"upload_avatar\" name=\"upload_video\" method=\"post\"
                      enctype=\"multipart/form-data\" role=\"form\">
                    <input type=\"hidden\" name=\"user_icon_delete\" value=\"1\">
                    <div id=\"load_avatar\" class=\"hide\">
                        <div class=\"form-group\">
                            <div id=\"dnd_upload_avatar\" class=\"drag\">
                                <div id=\"dndfiles_avatar\" class=\"drag-area\">
                                    <div class=\"drag\">
                                        ";
            // line 122
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("drag_photos"            ,"media"            ,            );
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
            // line 123
            echo "                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class=\"upload-btn\">
                                    <span data-role=\"filebutton\">
                                        <s>";
            // line 129
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_choose_file"            ,"start"            ,            );
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
            echo "</s>
                                        <input type=\"file\" name=\"avatar\" id=\"file_avatar\" />
                                    </span>
                                    &nbsp;(";
            // line 132
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("max"            ,"start"            ,            );
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
            // line 133
            echo "                                    ";
            $module =             null;
            $helper =             'utils';
            $name =             'bytesFormat';
            $params = array($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "upload_config", []), "max_size", [])            ,            );
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
            echo ")
                                </div>

                                <span id=\"attach_error_avatar\"></span>
                                <div id=\"attach_warning_avatar\"></div>
                            </div>
                        </div>

                        <button type=\"button\" name=\"btn_upload\" id=\"btn_upload_avatar\" class=\"btn btn-primary\">
                            ";
            // line 142
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_upload"            ,"start"            ,            );
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
            // line 143
            echo "                        </button>

                        <button type=\"button\" name=\"btn_use_webcamera\" id=\"btn_use_webcamera\" class=\"btn btn-default pull-right hide\">
                            ";
            // line 146
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wc_btn_use_webcamera"            ,"users"            ,            );
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
            // line 147
            echo "                        </button>
                    </div>
                </form>

                <form name=\"avatar\" id=\"stuff\" class=\"hide\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
                    <div class=\"form-group video_capture\">
                        <label id=\"allow\">
                            ";
            // line 154
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wc_get_user_camera"            ,"users"            ,            );
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
            // line 155
            echo "                        </label>
                        <video id=\"video\" width=\"100%\" height=\"240\" autoplay=\"autoplay\" class=\"img-responsive\"></video>
                        <canvas id=\"canvas\" class=\"img-responsive\" width=\"0\" height=\"0\"></canvas>
                        <input type=\"file\" name=\"avatar\" id=\"web_avatar\" class=\"hide\" />
                    </div>

                    <button type=\"button\" id=\"take_picture\" class=\"btn btn-primary\">
                        ";
            // line 162
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wc_take_picture"            ,"users"            ,            );
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
            // line 163
            echo "                    </button>

                    <button type=\"button\" id=\"repicture\" class=\"btn btn-primary hide\">
                        ";
            // line 166
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wc_repicture"            ,"users"            ,            );
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
            // line 167
            echo "                    </button>

                    <button type=\"button\" id=\"save_picture\" class=\"btn btn-primary hide\">
                        ";
            // line 170
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wc_save_picture"            ,"users"            ,            );
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
            // line 171
            echo "                    </button>

                    <button type=\"button\" class=\"btn btn-default pull-right hide\" id=\"btn_cancel_webcamera\">
                        ";
            // line 174
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_close"            ,"start"            ,            );
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
            // line 175
            echo "                    </button>
                </form>

                <script type=\"text/javascript\">
                    \$(function() {
                    loadScripts(
                    [
                            \"";
            // line 182
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"jquery.imgareaselect/jquery.imgareaselect.js"            ,"path"            ,            );
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
                            \"";
            // line 183
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"uploader.js"            ,"path"            ,            );
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
                            \"";
            // line 184
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"canvas-to-blob.min.js"            ,"path"            ,            );
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
                            \"";
            // line 185
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"webcamera.js"            ,"path"            ,            );
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
            echo "\"
                    ],
                            function() {
                            var upload_config = ";
            // line 188
            echo twig_jsonencode_filter($this->getAttribute(($context["avatar_data"] ?? null), "upload_config", []));
            echo ";
                            json_encode_data = ";
            // line 189
            echo twig_jsonencode_filter($this->getAttribute(($context["avatar_data"] ?? null), "selections", []));
            echo ";
                            user_avatar_selections = json_encode_data;
                            avatar_width = json_encode_data.grand.width;
                            avatar_height = json_encode_data.grand.height;
                            user_avatar_";
            // line 193
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".properties.id_user = ";
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ";
                            user_avatar_";
            // line 194
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".uninit_imageareaselect();
                            for (var i in user_avatar_selections) {
                            if (user_avatar_selections.hasOwnProperty(i)){
                            user_avatar_";
            // line 197
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".add_selection(i, 0, 0,
                                    parseInt(user_avatar_selections[i].width),
                                    parseInt(user_avatar_selections[i].height));
                            }
                            }

                    ";
            // line 203
            if ($this->getAttribute(($context["avatar_data"] ?? null), "have_avatar", [])) {
                // line 204
                echo "                                user_avatar_";
                echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
                echo ".init_imageareaselect();
                    ";
            }
            // line 206
            echo "
                                var lang_data = {
                                    errors: {
                                        file_missing: \"";
            // line 209
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_file_missing"            ,"uploads"            ,""            ,"js"            ,            );
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
            echo "\"
                                    }
                                };
                                avatar_uploader = new uploader({
                                    siteUrl: site_url,
                                        Accept: 'application/json',
                                        uploadUrl: 'users/upload_avatar',
                                        zoneId: 'dndfiles_avatar',
                                        fileId: 'file_avatar',
                                        formId: 'upload_avatar',
                                        filebarId: 'filebar_avatar',
                                        sendType: 'file',
                                        sendId: 'btn_upload_avatar',
                                        multiFile: false,
                                        messageId: 'attach_error_avatar',
                                        warningId: 'attach_warning_avatar',
                                        maxFileSize: upload_config.max_size,
                                        mimeType: upload_config.allowed_mimes,
                                        createThumb: true,
                                        thumbWidth: 200,
                                        thumbHeight: 200,
                                        thumbCrop: true,
                                        thumbJpeg: false,
                                        thumbBg: 'transparent',
                                        fileListInZone: true,
                                        lang: lang_data,
                                        langs: {
                                            exceeded: \"";
            // line 236
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("exceeded"            ,"media"            ,            );
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
                                            mime: \"";
            // line 237
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("mime"            ,"media"            ,            );
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
            echo "\"
                                        },
                                        cbOnUpload: function(name, data){
                                        if (typeof (user_avatar_";
            // line 240
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ") !== 'undefined') {
                                        if (data.logo && !\$.isEmptyObject(data.logo)) {
                                        \$('#image_content_avatar').find('.photo-edit').show();
                                        \$('#photo_source_recrop').attr('src', '');
                                        user_avatar_";
            // line 244
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".uninit_imageareaselect();
                                        for (var i in user_avatar_selections) {
                                            if (user_avatar_selections.hasOwnProperty(i)){
                                                user_avatar_";
            // line 247
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".add_selection(i, 0, 0,
                                                        parseInt(user_avatar_selections[i].width),
                                                        parseInt(user_avatar_selections[i].height));
                                            }
                                        }
                                        \$('#photo_source_recrop').attr('src', data.logo.file_url + '?' + new Date().getTime());
                                        if (\$('body').hasClass('mod-magazine')) {
                                            \$('#user_photo img').attr('src', data.logo.file_url + '?' + new Date().getTime());
                                            \$('#user_photo_bg').attr('style', 'background: url(' + data.logo.thumbs.middle + ') no-repeat center / cover;');
                                            \$('[data-block=\"ava-action_block\"]').prepend('<span data-action=\"remove-avatar\" class=\"btn btn-primary-inverted hide\" title=\"";
            // line 256
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_icon_delete"            ,"users"            ,            );
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
            echo "\"><i class=\"fa fa-times\"></i></span>');
                                        } else {
                                            \$('#user_photo img').attr('src', data.logo.thumbs.great + '?' + new Date().getTime());
                                        }
                                        \$('img[id^=avatar_' + id_user + ']').attr('src', data.logo.thumbs.small + '?' + new Date().getTime());
                                        user_avatar_";
            // line 261
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".init_imageareaselect();
                                        var images = \$('img');

                                        if (data.old_logo && !\$.isEmptyObject(data.old_logo)) {
                                            for (var i in data.old_logo.thumbs) {
                                                if (data.old_logo.thumbs.hasOwnProperty(i)) {
                                                    images.filter('[src^=\"' + data.old_logo.thumbs[i] + '\"]')
                                                         .attr('src', data.logo.thumbs[i] + '?' + new Date().getTime());
                                                }
                                            }
                                        }

                                        if (data.old_logo_moderation && !\$.isEmptyObject(data.old_logo_moderation)) {
                                            for (var i in data.old_logo_moderation.thumbs) {
                                                if (data.old_logo_moderation.thumbs.hasOwnProperty(i)) {
                                                    images.filter('[src^=\"' + data.old_logo_moderation.thumbs[i] + '\"]')
                                                            .attr('src', data.logo.thumbs[i] + '?' + new Date().getTime());
                                                }
                                            }
                                        }

                                        sendAnalytics('computer_upload_avatar_success', 'user_avatar_success', 'user');

                                        }
                                        }
                                        },
                                        cbOnComplete: function(data){
                                            if (data.errors.length) {
                                                error_object.show_error_block(data.errors, 'error');
                                                sendAnalytics('computer_upload_avatar_fail', 'user_avatar_fail', 'user');
                                            }
                                            user_avatar_";
            // line 292
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".destroy_window();
                                            user_avatar_";
            // line 293
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".properties.callback(user_avatar_";
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ");
                                        },
                                        ailedjqueryFormPluginUrl: \"";
            // line 295
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"jquery.form.min.js"            ,"path"            ,            );
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
            echo "\"
                                });
                                avatar_web_uploader = new uploader({
                                siteUrl: site_url,
                                        Accept: 'application/json',
                                        uploadUrl: 'users/upload_avatar',
                                        fileId: 'web_avatar',
                                        formId: 'upload_avatar',
                                        sendType: 'file',
                                        sendId: 'save_picture',
                                        multiFile: false,
                                        messageId: 'attach_error_avatar',
                                        warningId: 'attach_warning_avatar',
                                        maxFileSize: upload_config.max_size,
                                        mimeType: upload_config.allowed_mimes,
                                        createThumb: true,
                                        thumbWidth: 200,
                                        thumbHeight: 200,
                                        thumbCrop: true,
                                        thumbJpeg: false,
                                        thumbBg: 'transparent',
                                        fileListInZone: false,
                                        langs: {
                                            exceeded: \"";
            // line 318
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("exceeded"            ,"media"            ,            );
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
                                            mime: \"";
            // line 319
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("mime"            ,"media"            ,            );
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
            echo "\"
                                        },
                                        cbOnUpload: function(name, data){
                                        if (data.logo && !\$.isEmptyObject(data.logo)) {
                                        \$('#stuff, #btn_cancel_webcamera').hide(300);
                                        \$('#btn_change_photo').show();
                                        \$('#image_content_avatar').find('.photo-edit').show();
                                        \$('#photo_source_recrop').attr('src', '');
                                        user_avatar_";
            // line 327
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".uninit_imageareaselect();
                                        for (var i in user_avatar_selections) {
                                        if (user_avatar_selections.hasOwnProperty(i)) {
                                        user_avatar_";
            // line 330
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".add_selection(i, 0, 0,
                                                parseInt(user_avatar_selections[i].width),
                                                parseInt(user_avatar_selections[i].height));
                                        }
                                        }
                                        \$('#photo_source_recrop').attr('src', data.logo.file_url + '?' + new Date().getTime());
                                        \$('#user_photo > img').attr('src', data.logo.thumbs.great + '?' + new Date().getTime());
                                        \$('img[id^=avatar_' + id_user + ']').attr('src', data.logo.thumbs.small + '?' + new Date().getTime());
                                        user_avatar_";
            // line 338
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".init_imageareaselect();
                                        var images = \$('img');

                                        if (data.old_logo && !\$.isEmptyObject(data.old_logo)) {
                                        for (var i in data.old_logo.thumbs) {
                                        if (data.old_logo.thumbs.hasOwnProperty(i)) {
                                        images.filter('[src^=\"' + data.old_logo.thumbs[i] + '\"]')
                                                .attr('src', data.logo.thumbs[i] + '?' + new Date().getTime());
                                        }
                                        }
                                        }

                                        if (data.old_logo_moderation && !\$.isEmptyObject(data.old_logo_moderation)) {
                                        for (var i in data.old_logo_moderation.thumbs) {
                                        if (data.old_logo_moderation.thumbs.hasOwnProperty(i)) {
                                        images.filter('[src^=\"' + data.old_logo_moderation.thumbs[i] + '\"]')
                                                .attr('src', data.logo.thumbs[i] + '?' + new Date().getTime());
                                        }
                                        }
                                        }

                                        sendAnalytics('web_upload_avatar_success', 'user_avatar_success', 'user');

                                        user_avatar_";
            // line 361
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".destroy_window();
                                        }
                                        },
                                        cbOnComplete: function(data) {
                                        if (data.errors.length) {
                                        error_object.show_error_block(data.errors, 'error');
                                        sendAnalytics('web_upload_avatar_fail', 'user_avatar_fail', 'user');
                                        }
                                        user_avatar_";
            // line 369
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ".properties.callback(user_avatar_";
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ");
                                        },
                                        jqueryFormPluginUrl: '";
            // line 371
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"jquery.form.min.js"            ,"path"            ,            );
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
            echo "'
                                });
                                users_avatar_web_camera = new webcamera({
                                wc_width: avatar_width,
                                        wc_height: avatar_height,
                                        wc_alert: '";
            // line 376
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wc_alert"            ,"users"            ,""            ,"js"            ,            );
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
                                        wc_load_avatar: 'load_avatar',
                                        wc_user_avatar: user_avatar_";
            // line 378
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo ",
                                        wc_photo_edit: 'image_content_avatar',
                                });
                                \$('.media-photo-editor__recrop-sizes-toggle').dropdown();
                                },
                        ['user_avatar_";
            // line 383
            echo $this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "id", []);
            echo "', 'avatar_uploader', 'avatar_web_uploader', 'users_avatar_web_camera'],
                        {async: false}
                        );
                        });
                </script>
            </div>
            ";
            // line 389
            if (( !$this->getAttribute(($context["avatar_data"] ?? null), "have_avatar", []) || ($context["uploader"] ?? null))) {
                // line 390
                echo "                <script>
                    \$(document).ready(function() {
                      users_avatar_web_camera.properties.createNewWindow = true;
                      users_avatar_web_camera.showLoadAvatar();
                    });
                </script>
            ";
            }
            // line 397
            echo "        ";
        }
        // line 398
        echo "    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "ajax_user_avatar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1217 => 398,  1214 => 397,  1205 => 390,  1203 => 389,  1194 => 383,  1186 => 378,  1162 => 376,  1135 => 371,  1128 => 369,  1117 => 361,  1091 => 338,  1080 => 330,  1074 => 327,  1044 => 319,  1021 => 318,  976 => 295,  969 => 293,  965 => 292,  931 => 261,  904 => 256,  892 => 247,  886 => 244,  879 => 240,  854 => 237,  831 => 236,  782 => 209,  777 => 206,  771 => 204,  769 => 203,  760 => 197,  754 => 194,  748 => 193,  741 => 189,  737 => 188,  712 => 185,  689 => 184,  666 => 183,  643 => 182,  634 => 175,  613 => 174,  608 => 171,  587 => 170,  582 => 167,  561 => 166,  556 => 163,  535 => 162,  526 => 155,  505 => 154,  496 => 147,  475 => 146,  470 => 143,  449 => 142,  417 => 133,  396 => 132,  371 => 129,  363 => 123,  342 => 122,  327 => 112,  325 => 111,  314 => 102,  309 => 99,  303 => 95,  282 => 94,  277 => 91,  275 => 90,  270 => 87,  249 => 86,  244 => 83,  223 => 82,  218 => 79,  216 => 78,  212 => 76,  205 => 71,  187 => 69,  186 => 64,  182 => 62,  177 => 59,  175 => 58,  165 => 50,  158 => 48,  153 => 47,  146 => 45,  141 => 44,  139 => 43,  118 => 24,  97 => 23,  89 => 17,  82 => 15,  77 => 14,  70 => 12,  65 => 11,  63 => 10,  57 => 6,  36 => 5,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_user_avatar.twig", "/home/mliadov/public_html/application/modules/users/views/gentelella/ajax_user_avatar.twig");
    }
}
