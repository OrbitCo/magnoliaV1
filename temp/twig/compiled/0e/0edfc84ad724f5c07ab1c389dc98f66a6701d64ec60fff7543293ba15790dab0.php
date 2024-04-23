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
class __TwigTemplate_5f97e84cbf67785b897dc2796b01052b22709bb13011ba3f19e5f810ab48039d extends \Twig\Template
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
        echo "      <div class=\"media-gallery-editor__media-source-box container\">
        <div class=\"photo-edit hide\" data-area=\"recrop\">
          <div class=\"source-box\">
            <div id=\"photo_source_recrop_box\" class=\"media-gallery-editor__media-source photo-source-box\">
              ";
        // line 10
        if ($this->getAttribute($this->getAttribute(($context["avatar_data"] ?? null), "user", []), "user_logo_moderation", [])) {
            // line 11
            echo "                <img id=\"photo_source_recrop\" src=\"";
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
            echo "                <img id=\"photo_source_recrop\" src=\"";
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
        echo "            </div>
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
                  <i id=\"photo_crop\" class=\"fas fa-crop-alt w fa-2x icon-hover\"></i>
                </li>
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
        // line 46
        $module =         null;
        $helper =         'users';
        $name =         'formatAvatar';
        $params = array(["user" => $this->getAttribute(($context["avatar_data"] ?? null), "user", []), "size" => "grand", "class" => "grand img-responsive"]        ,        );
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
        // line 47
        echo "        </div>
      </div>
      <div class=\"media-preloader hide\" id=\"media_preloader\"></div>
    </div>
  </div>

  <div class=\"container\">
    <div class=\"row mb10\">
      ";
        // line 55
        if ((($context["user_type_logo"] ?? null) != "admin")) {
            // line 56
            echo "        <div class=\"col-xs-12 col-sm-12 col-md-8 col-lg-8\">
          <div class=\"media-popup-info\">
            <div data-section=\"comments\">
              ";
            // line 59
            $module =             null;
            $helper =             'comments';
            $name =             'comments_form';
            $params = array(["gid" => "user_avatar", "id_obj" => $this->getAttribute($this->getAttribute(            // line 61
($context["avatar_data"] ?? null), "user", []), "id", []), "hidden" => 0, "view" => "popup", "max_height" => 500, "order_by" => "asc", "count" => $this->getAttribute($this->getAttribute(            // line 66
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
            // line 68
            echo "            </div>
            <div data-section=\"albums\" class=\"hide\"></div>
          </div>
        </div>
      ";
        }
        // line 73
        echo "
      <div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">
        ";
        // line 75
        if (($this->getAttribute(($context["avatar_data"] ?? null), "is_owner", []) || (($context["user_type_logo"] ?? null) == "admin"))) {
            // line 76
            echo "          <div class=\"media-popup-options\" id=\"media_menu\">
            <div class=\"clearfix mb10\">
              <div class=\"popup-opt-title\">
                ";
            // line 79
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
            // line 80
            echo "              </div>
              <div class=\"popup-opt-block\">
                <button type=\"button\" class=\"btn btn-default\" data-section=\"recrop\">
                  <i class=\"fa fa-crop\"></i> ";
            // line 83
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
            // line 84
            echo "                </button>
              </div>
            </div>
            ";
            // line 87
            if ((($context["user_type_logo"] ?? null) != "admin")) {
                // line 88
                echo "              <div class=\"clearfix mb10\">
                <div class=\"popup-opt-block\">
                  <button type=\"button\" name=\"btn_change_photo\" id=\"btn_change_photo\" class=\"btn btn-primary\">
                    ";
                // line 91
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
                // line 92
                echo "                  </button>
                </div>
              </div>
            ";
            }
            // line 96
            echo "          </div>

        ";
        }
        // line 99
        echo "      </div>
    </div>
  </div>
</div>


<div class=\"content-block load_content\">
  <div class=\"media-photo-editor\">
    ";
        // line 107
        if ($this->getAttribute(($context["avatar_data"] ?? null), "is_owner", [])) {
            // line 108
            echo "      <link rel=\"stylesheet\" type=\"text/css\"
            href=\"";
            // line 109
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
            // line 119
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
            // line 120
            echo "                  </div>
                </div>
              </div>
              <div>
                <div class=\"upload-btn\">
                                    <span data-role=\"filebutton\">
                                        <s>";
            // line 126
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
                                        <input type=\"file\" name=\"avatar\" id=\"file_avatar\"/>
                                    </span>
                  &nbsp;(";
            // line 129
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
            // line 130
            echo "                  ";
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
            // line 139
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
            // line 140
            echo "            </button>

            <button type=\"button\" name=\"btn_use_webcamera\" id=\"btn_use_webcamera\"
                    class=\"btn btn-default pull-right hide\">
              ";
            // line 144
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
            // line 145
            echo "            </button>
          </div>
        </form>

        <form name=\"avatar\" id=\"stuff\" class=\"hide\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
          <div class=\"form-group video_capture\">
            <label id=\"allow\">
              ";
            // line 152
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
            // line 153
            echo "            </label>
            <video id=\"video\" width=\"100%\" height=\"240\" autoplay=\"autoplay\" class=\"img-responsive\"></video>
            <canvas id=\"canvas\" class=\"img-responsive\" width=\"0\" height=\"0\"></canvas>
            <input type=\"file\" name=\"avatar\" id=\"web_avatar\" class=\"hide\"/>
          </div>

          <button type=\"button\" id=\"take_picture\" class=\"btn btn-primary\">
            ";
            // line 160
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
            // line 161
            echo "          </button>

          <button type=\"button\" id=\"repicture\" class=\"btn btn-primary hide\">
            ";
            // line 164
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
            // line 165
            echo "          </button>

          <button type=\"button\" id=\"save_picture\" class=\"btn btn-primary hide\">
            ";
            // line 168
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
            // line 169
            echo "          </button>

          <button type=\"button\" class=\"btn btn-default pull-right hide\" id=\"btn_cancel_webcamera\">
            ";
            // line 172
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
            // line 173
            echo "          </button>
        </form>

        <script type=\"text/javascript\">
          \$(function () {
            loadScripts(
              [
                \"";
            // line 180
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
            // line 181
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
            // line 182
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
            // line 183
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
              function () {
                var upload_config = ";
            // line 186
            echo twig_jsonencode_filter($this->getAttribute(($context["avatar_data"] ?? null), "upload_config", []));
            echo ";
                json_encode_data = ";
            // line 187
            echo twig_jsonencode_filter($this->getAttribute(($context["avatar_data"] ?? null), "selections", []));
            echo ";
                user_avatar_selections = json_encode_data;
                avatar_width = json_encode_data.grand.width;
                avatar_height = json_encode_data.grand.height;
                user_avatar.uninit_imageareaselect();
                for (var i in user_avatar_selections) {
                  if (user_avatar_selections.hasOwnProperty(i)) {
                    user_avatar.add_selection(i, 0, 0,
                      parseInt(user_avatar_selections[i].width),
                      parseInt(user_avatar_selections[i].height));
                  }
                }

                ";
            // line 200
            if ($this->getAttribute(($context["avatar_data"] ?? null), "have_avatar", [])) {
                // line 201
                echo "                user_avatar.init_imageareaselect();
                ";
            }
            // line 203
            echo "
                var lang_data = {
                  errors: {
                    file_missing: \"";
            // line 206
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
            // line 233
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("exceeded"            ,"media"            ,""            ,"js"            ,            );
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
            // line 234
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("mime"            ,"media"            ,""            ,"js"            ,            );
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
                  cbOnUpload: function (name, data) {
                    if (typeof (user_avatar) !== 'undefined') {
                      if (data.logo && !\$.isEmptyObject(data.logo)) {
                        \$('#image_content_avatar').find('.photo-edit').show();
                        \$('#photo_source_recrop').attr('src', '');
                        user_avatar.uninit_imageareaselect();
                        for (var i in user_avatar_selections) {
                          if (user_avatar_selections.hasOwnProperty(i)) {
                            user_avatar.add_selection(i, 0, 0,
                              parseInt(user_avatar_selections[i].width),
                              parseInt(user_avatar_selections[i].height));
                          }
                        }
                        \$('#photo_source_recrop').attr('src', data.logo.file_url + '?' + new Date().getTime());
                        if (\$('body').hasClass('mod-magazine')) {
                          \$('#user_photo img').attr('src', data.logo.file_url + '?' + new Date().getTime());
                          \$('#user_photo_bg').attr('style', 'background: url(' + data.logo.thumbs.middle + ') no-repeat center / cover;');
                          if (\$('[data-action=\"remove-avatar\"]').length === 0) {
                            \$('[data-block=\"ava-action_block\"]').prepend('<span data-action=\"remove-avatar\" class=\"btn btn-primary-inverted hide\" title=\"";
            // line 254
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_icon_delete"            ,"users"            ,""            ,"js"            ,            );
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
                          }
                        } else {
                          \$('#user_photo img').attr('src', data.logo.thumbs.great + '?' + new Date().getTime());
                        }
                        \$('img[id^=avatar_' + id_user + ']').attr('src', data.logo.thumbs.small + '?' + new Date().getTime());
                        user_avatar.init_imageareaselect();
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
                        // click to next button
                        if (\$(\".registration-photo a.btn-block\").length){
                          \$(\".registration-photo a.btn-block\").trigger('click');
                        }
                      }
                    }
                  },
                  cbOnComplete: function (data) {
                    if (data.errors.length) {
                      error_object.show_error_block(data.errors, 'error');
                      sendAnalytics('computer_upload_avatar_fail', 'user_avatar_fail', 'user');
                    }
                    user_avatar.destroy_window();
                    user_avatar.properties.callback(user_avatar);
                  },
                  ailedjqueryFormPluginUrl: \"";
            // line 297
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
            // line 320
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("exceeded"            ,"media"            ,""            ,"js"            ,            );
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
            // line 321
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("mime"            ,"media"            ,""            ,"js"            ,            );
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
                  cbOnUpload: function (name, data) {
                    if (data.logo && !\$.isEmptyObject(data.logo)) {
                      \$('#stuff, #btn_cancel_webcamera').hide(300);
                      \$('#btn_change_photo').show();
                      \$('#image_content_avatar').find('.photo-edit').show();
                      \$('#photo_source_recrop').attr('src', '');
                      user_avatar.uninit_imageareaselect();
                      for (var i in user_avatar_selections) {
                        if (user_avatar_selections.hasOwnProperty(i)) {
                          user_avatar.add_selection(i, 0, 0,
                            parseInt(user_avatar_selections[i].width),
                            parseInt(user_avatar_selections[i].height));
                        }
                      }
                      \$('#photo_source_recrop').attr('src', data.logo.file_url + '?' + new Date().getTime());
                      \$('#user_photo > img').attr('src', data.logo.thumbs.great + '?' + new Date().getTime());
                      \$('img[id^=avatar_' + id_user + ']').attr('src', data.logo.thumbs.small + '?' + new Date().getTime());
                      user_avatar.init_imageareaselect();
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

                      user_avatar.destroy_window();
                    }
                  },
                  cbOnComplete: function (data) {
                    if (data.errors.length) {
                      error_object.show_error_block(data.errors, 'error');
                      sendAnalytics('web_upload_avatar_fail', 'user_avatar_fail', 'user');
                    }
                    user_avatar.properties.callback(user_avatar);
                  },
                  jqueryFormPluginUrl: '";
            // line 373
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
                  wc_alert: \"";
            // line 378
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
            echo "\",
                  wc_load_avatar: 'load_avatar',
                  wc_user_avatar: user_avatar,
                  wc_photo_edit: 'image_content_avatar',
                });
                \$('.media-photo-editor__recrop-sizes-toggle').dropdown();
              },
              ['user_avatar', 'avatar_uploader', 'avatar_web_uploader', 'users_avatar_web_camera'],
              {async: false}
            );
          });
        </script>
      </div>
    ";
            // line 391
            if (( !$this->getAttribute(($context["avatar_data"] ?? null), "have_avatar", []) || ($context["uploader"] ?? null))) {
                // line 392
                echo "      <script>
        \$(function () {
          try {
            users_avatar_web_camera.properties.createNewWindow = true;
            users_avatar_web_camera.showLoadAvatar();
          } catch (e) {
            console.error(e)
          }
        });
      </script>
    ";
            }
            // line 403
            echo "    ";
        }
        // line 404
        echo "  </div>
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
        return array (  1169 => 404,  1166 => 403,  1153 => 392,  1151 => 391,  1116 => 378,  1089 => 373,  1015 => 321,  992 => 320,  947 => 297,  882 => 254,  840 => 234,  817 => 233,  768 => 206,  763 => 203,  759 => 201,  757 => 200,  741 => 187,  737 => 186,  712 => 183,  689 => 182,  666 => 181,  643 => 180,  634 => 173,  613 => 172,  608 => 169,  587 => 168,  582 => 165,  561 => 164,  556 => 161,  535 => 160,  526 => 153,  505 => 152,  496 => 145,  475 => 144,  469 => 140,  448 => 139,  416 => 130,  395 => 129,  370 => 126,  362 => 120,  341 => 119,  327 => 109,  324 => 108,  322 => 107,  312 => 99,  307 => 96,  301 => 92,  280 => 91,  275 => 88,  273 => 87,  268 => 84,  247 => 83,  242 => 80,  221 => 79,  216 => 76,  214 => 75,  210 => 73,  203 => 68,  185 => 66,  184 => 61,  180 => 59,  175 => 56,  173 => 55,  163 => 47,  142 => 46,  118 => 24,  97 => 23,  89 => 17,  82 => 15,  77 => 14,  70 => 12,  65 => 11,  63 => 10,  57 => 6,  36 => 5,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_user_avatar.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\ajax_user_avatar.twig");
    }
}
