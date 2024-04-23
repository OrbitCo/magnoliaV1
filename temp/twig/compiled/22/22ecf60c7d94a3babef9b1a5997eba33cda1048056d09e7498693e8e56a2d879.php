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

/* wall_block.twig */
class __TwigTemplate_20cc6566d445e9ce55ca07085d73867e6679a7589622f77d5172dc6b21275f9f extends \Twig\Template
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
        if (($this->getAttribute(($context["wall_params"] ?? null), "place", []) == "homepage")) {
            // line 2
            echo "  <div class=\"mb10 title-block\" data-title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("recent_activity"            ,"wall_events"            ,            );
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
            echo "\" data-id=\"wall-title\"
       id=\"wall-title\">
    ";
            // line 4
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("recent_activity"            ,"wall_events"            ,            );
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
            // line 5
            echo "    <span id=\"wall_permissions_link\" class=\"a fright\"
          title=\"";
            // line 6
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_wall_settings"            ,"wall_events"            ,            );
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
          onclick=\"ajax_permissions_form(site_url+'wall_events/ajax_user_permissions/');\">
            <i class=\"fa fa-cog\"></i>
        </span>
  </div>
";
        }
        // line 12
        if ($this->getAttribute(($context["wall_params"] ?? null), "show_post_form", [])) {
            // line 13
            echo "  <div id=\"wall_post\" class=\"hide post-form wide\">
    <form id=\"wall_upload_form\" method=\"post\" enctype=\"multipart/form-data\" name=\"wall_upload_form\"
          action=\"";
            // line 15
            echo ($context["site_url"] ?? null);
            echo "wall_events/post_form/";
            echo $this->getAttribute(($context["wall_params"] ?? null), "id_wall", []);
            echo "/";
            echo $this->getAttribute(($context["wall_params"] ?? null), "place", []);
            echo "\">
      <input type=\"hidden\" name=\"id\" value=\"0\"/>
      <input type=\"hidden\" name=\"id_wall\" value=\"";
            // line 17
            echo $this->getAttribute(($context["wall_params"] ?? null), "id_wall", []);
            echo "\"/>
      <div class=\"form-input b-timeline-addpost clearfix\">
        <div class=\"form-group b-timeline-addpost__textarea\">
                    <textarea id=\"wall_post_text\" name=\"text\"
                              placeholder=\"";
            // line 21
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("post_placeholder"            ,"wall_events"            ,            );
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
                              class=\"form-control b-timeline-addpost_message innactive\"></textarea>
          <input
            onclick=\"sendAnalytics('wall_events_post', 'communication', 'user'); sendAnalytics('post_send', 'home_wall', 'user');\"
            type=\"button\" name=\"btn_send\" id=\"btn_send\" value=\"";
            // line 25
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_send"            ,"start"            ,            );
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
            class=\"btn btn-primary\"/>
        </div>

        <div class=\"b-timeline-addpost__uplodad\" id=\"wall_post_upload\">
          <div id=\"wall_post_upload_form\" class=\"b-timeline-addpost__file hide\">
            <div class=\"v\">
              <div class=\"drag\">
                <div id=\"dndfiles\" class=\"drag-area\">
                  <ins>
                    ";
            // line 35
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("drag_files"            ,"wall_events"            ,            );
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
            echo "                  </ins>
                </div>
              </div>
              <div>
                <div class=\"upload-btn\">
\t\t\t\t\t\t\t\t\t<span data-role=\"filebutton\">
\t\t\t\t\t\t\t\t\t\t<s>";
            // line 42
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
\t\t\t\t\t\t\t\t\t\t<input type=\"file\" name=\"multiupload\" id=\"multiupload\" multiple/>
\t\t\t\t\t\t\t\t\t</span>
                  <div class=\"size-info mt5\">
                    ";
            // line 46
            if ((($this->getAttribute($this->getAttribute(($context["wall_params"] ?? null), "audio_upload_config", []), "max_size", []) || $this->getAttribute($this->getAttribute(            // line 47
($context["wall_params"] ?? null), "image_upload_config", []), "max_size", [])) || $this->getAttribute($this->getAttribute(            // line 48
($context["wall_params"] ?? null), "video_upload_config", []), "max_size", []))) {
                // line 49
                echo "                      &nbsp;(";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("max"                ,"wall_events"                ,                );
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
                echo ".
                      ";
                // line 50
                if ($this->getAttribute($this->getAttribute(($context["wall_params"] ?? null), "audio_upload_config", []), "max_size", [])) {
                    // line 51
                    echo "                        ";
                    $module =                     null;
                    $helper =                     'utils';
                    $name =                     'bytesFormat';
                    $params = array($this->getAttribute($this->getAttribute(($context["wall_params"] ?? null), "audio_upload_config", []), "max_size", [])                    ,                    );
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
                    // line 52
                    echo "                        ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("audios"                    ,"wall_events"                    ,                    );
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
                    echo ".
                      ";
                }
                // line 54
                echo "                      ";
                if ($this->getAttribute($this->getAttribute(($context["wall_params"] ?? null), "image_upload_config", []), "max_size", [])) {
                    // line 55
                    echo "                        ";
                    $module =                     null;
                    $helper =                     'utils';
                    $name =                     'bytesFormat';
                    $params = array($this->getAttribute($this->getAttribute(($context["wall_params"] ?? null), "image_upload_config", []), "max_size", [])                    ,                    );
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
                    // line 56
                    echo "                        ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("images"                    ,"wall_events"                    ,                    );
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
                    echo ".
                      ";
                }
                // line 58
                echo "                      ";
                if ($this->getAttribute($this->getAttribute(($context["wall_params"] ?? null), "video_upload_config", []), "max_size", [])) {
                    // line 59
                    echo "                        ";
                    $module =                     null;
                    $helper =                     'utils';
                    $name =                     'bytesFormat';
                    $params = array($this->getAttribute($this->getAttribute(($context["wall_params"] ?? null), "video_upload_config", []), "max_size", [])                    ,                    );
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
                    // line 60
                    echo "                        ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("videos"                    ,"wall_events"                    ,                    );
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
                    echo ".
                      ";
                }
                // line 61
                echo ")
                    ";
            }
            // line 63
            echo "                  </div>
                </div>
                <span id=\"attach-input-error\"></span>
                <div id=\"attach-input-warning\"></div>
              </div>
            </div>
          </div>

          <div class=\"b-timeline-addpost__embed hide\" id=\"wall_post_embed_form\">
            <div>
              ";
            // line 73
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("embed_code"            ,"wall_events"            ,            );
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
            </div>
            <div>
              <textarea id=\"wall_embed_code\" class=\"form-input form-control\" name=\"embed_code\"></textarea>
            </div>
          </div>
        </div>

        <div class=\"b-timeline-addpost__controls\">
          <div class=\"row\">
            <div class=\"col-sm-8 col-md-8\">
              <a href=\"javascript:void(0);\" id=\"b-timeline-addpost__linkfile\"
                 onclick=\"\$('#wall_post_embed_form').hide(); \$('#wall_post_upload_form').toggle();\">
                ";
            // line 86
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("add_uploads"            ,"wall_events"            ,            );
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
            echo "              </a>&nbsp;
              <a href=\"javascript:void(0);\" id=\"b-timeline-addpost__linkembed\"
                 onclick=\"\$('#wall_post_upload_form').hide(); \$('#wall_post_embed_form').toggle();\">
                ";
            // line 90
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("add_embed"            ,"wall_events"            ,            );
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
            // line 91
            echo "              </a>
            </div>
            <div class=\"col-sm-4 col-md-4 b-timeline-addpost__controls_right\">
              <!-- send button will be here on textarea focus-->
            </div>
          </div>
        </div>


      </div>
    </form>
  </div>
";
        }
        // line 104
        echo "
<div id=\"wall\" class=\"wall\"></div>

<script>
  var wall
  \$(function () {
    var wall_params = ";
        // line 110
        echo twig_jsonencode_filter(($context["wall_params"] ?? null));
        echo " ||
    {}

    wall_params.id = 'wall'
    wall_params.onInit = function () {
      \$('#wall_post').removeClass('hide');
    }

    loadScripts(
      \"";
        // line 119
        $module =         null;
        $helper =         'utils';
        $name =         'jscript_by_theme';
        $params = array("wall_events"        ,"wall.js"        ,"path"        ,"flatty"        ,        );
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
        wall = new Wall().init(wall_params).loadEvents()
      },
      'wall',
      { async: false }
    )

    \$('#wall_permissions_link').click(function () {
      ajax_permissions_form(site_url + 'wall_events/ajax_user_permissions/')
      return false
    })

    user_ajax_permissions = new loadingContent({
      loadBlockWidth: '400px',
      loadBlockLeftType: 'center',
      loadBlockTopType: 'top',
      loadBlockTopPoint: 100,
      closeBtnClass: 'w'
    })

    if (wall_params.show_post_form) {
      loadScripts(
        \"";
        // line 142
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"uploader.js"        ,"path"        ,        );
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
          var lang_data = {
            errors: {
              file_missing: \"";
        // line 146
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_file_missing"        ,"uploads"        ,        );
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
          }
          mu = new uploader({
            Accept: 'application/json',
            siteUrl: site_url,
            uploadUrl: wall_params.url_upload,
            zoneId: 'dndfiles',
            fileId: 'multiupload',
            formId: 'wall_upload_form',
            sendType: 'file',
            sendId: 'btn_send',
            messageId: 'attach-input-error',
            warningId: 'attach-input-warning',
            maxFileSize: wall_params.max_upload_size,
            mimeType: wall_params.allowed_mimes,
            lang: lang_data,
            langs: {
              exceeded: \"";
        // line 164
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("exceeded"        ,"media"        ,        );
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
        // line 165
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("mime"        ,"media"        ,        );
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
            isFileEmpty: true,
            cbOnComplete: function (data) {
              wall.properties.uploaded = true
              if (data.id) {
                \$('#wall_upload_form').find('input[name=\"id\"]').val(data.id)
              }
              if (data.joined_id) {
                \$('#wall_event_' + data.joined_id).remove()
              }
            },
            cbOnQueueComplete: function () {
              \$('#wall_upload_form').find('input[name=\"id\"]').val('0')
              if (!wall.properties.uploaded) {
                wall.newPost(function () {
                  wall.loadEvents('new')
                })
              } else {
                \$('#wall_post_text').val('')
                \$('#wall_embed_code').val('')
                wall.loadEvents('new')
              }
              wall.properties.uploaded = false
            },
            createThumb: true,
            thumbWidth: 100,
            thumbHeight: 100,
            thumbCrop: true,
            thumbJpeg: false,
            thumbBg: 'transparent',
            fileListInZone: true,
            jqueryFormPluginUrl: '";
        // line 197
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery.form.min.js"        ,"path"        ,        );
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
          })
        },
        ['mu'],
        { async: false }
      )
    }

    function wallpostActivate () {

    }

    \$('#wall_post_text').on('focus', function (event) {
      \$(this).removeClass('innactive')
      \$('.b-timeline-addpost__controls').show()

      \$('#btn_send').appendTo('.b-timeline-addpost__controls_right')
    })

    \$('body').on('click', function (e) {
      var container = \$('.b-timeline-addpost')
      var parrent = \$('#wall_post_text').parent()

      if (container.has(e.target).length === 0) {
        \$('#wall_post_text').addClass('innactive')
        \$('.b-timeline-addpost__controls').hide()
        \$('.b-timeline-addpost__file').hide()
        \$('.b-timeline-addpost__embed').hide()

        \$('#btn_send').appendTo(parrent)
      }
    })
  })

  \$(document)
    .on('dragenter', '#wall_post', function () {
      \$('#wall_post_upload_form').slideDown()
    })
    .on('pjax:start', function (e) {
      \$(document).off('dragenter', '#wall_post')
    })

  function ajax_permissions_form (url) {
    \$.ajax({
      url: url,
      cache: false,
      data: { redirect_url: location.href },
      success: function (data) {
        user_ajax_permissions.show_load_block(data)
      },
      type: 'POST'
    })
  }
</script>
";
    }

    public function getTemplateName()
    {
        return "wall_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  742 => 197,  688 => 165,  665 => 164,  625 => 146,  599 => 142,  554 => 119,  542 => 110,  534 => 104,  519 => 91,  498 => 90,  493 => 87,  472 => 86,  437 => 73,  425 => 63,  421 => 61,  396 => 60,  374 => 59,  371 => 58,  346 => 56,  324 => 55,  321 => 54,  296 => 52,  274 => 51,  272 => 50,  248 => 49,  246 => 48,  245 => 47,  244 => 46,  218 => 42,  210 => 36,  189 => 35,  157 => 25,  131 => 21,  124 => 17,  115 => 15,  111 => 13,  109 => 12,  81 => 6,  78 => 5,  57 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "wall_block.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\wall_events\\views\\flatty\\wall_block.twig");
    }
}
