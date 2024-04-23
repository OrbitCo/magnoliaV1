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

/* add_photos.twig */
class __TwigTemplate_a37db2a31a8d8a41922af2049a8c1fc2cf370e07b997a8985636c8668ee983f9 extends \Twig\Template
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
        $context["rand"] = twig_random($this->env, 11111, 99999);
        // line 2
        echo "<div class=\"content-block load_content\">
    <h1>
        ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_photos"        ,"media"        ,        );
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
        echo "    </h1>
    <div class=\"\">
        <form id=\"item_form";
        // line 7
        echo ($context["rand"] ?? null);
        echo "\" onsubmit=\"return;\"
              action=\"\" method=\"post\"
              enctype=\"multipart/form-data\" name=\"item_form\" role=\"form\">
            <div class=\"form-group\">
                <div class=\"f-block\">
                    <div id=\"dnd_upload";
        // line 12
        echo ($context["rand"] ?? null);
        echo "\" class=\"drag drag-area-btn\">
                        <div id=\"dndfiles";
        // line 13
        echo ($context["rand"] ?? null);
        echo "\" class=\"drag-area\">
                            <div class=\"drag\">
                                <div class=\"upload-btn\">
                                    <span data-role=\"filebutton\" class=\"btn btn-primary\">
                                        <s>
                                            ";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_choose_file"        ,"start"        ,        );
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
        echo "                                        </s>
                                        <input type=\"file\" name=\"multiUpload\" id=\"multiUpload";
        // line 20
        echo ($context["rand"] ?? null);
        echo "\"
                                               accept=\"image/*;capture=camera\" multiple />
                                    </span>
                                    <p class=\"mt20\">
                                        or ";
        // line 24
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("drag_photos"        ,"media"        ,        );
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
                                </div>
                                <div class=\"upload-area\">
                                    <i class=\"fas fa-cloud-upload-alt\"></i>
                                    <p>";
        // line 29
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_upload_photo"        ,"media"        ,        );
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
        echo "</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id=\"dnd_upload_info\">
                        <p class=\"text-center max-size\">
                            ";
        // line 36
        if ($this->getAttribute(($context["media_config"] ?? null), "max_size", [])) {
            // line 37
            echo "                                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_max_file_size"            ,"media"            ,            );
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
            // line 38
            echo "                                ";
            $module =             null;
            $helper =             'utils';
            $name =             'bytesFormat';
            $params = array($this->getAttribute(($context["media_config"] ?? null), "max_size", [])            ,            );
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
            // line 39
            echo "                            ";
        }
        // line 40
        echo "                        </p>
                    </div>
                    <span id=\"attach-input-error";
        // line 42
        echo ($context["rand"] ?? null);
        echo "\"></span>
                    <div id=\"attach-input-warning";
        // line 43
        echo ($context["rand"] ?? null);
        echo "\"></div>
                </div>
            </div>
            <div id=\"upload_properties\" class=\"hide\">
                <div id=\"album_content";
        // line 47
        echo ($context["rand"] ?? null);
        echo "\">
                    <div class=\"form-group ";
        // line 48
        if ( !($context["user_albums"] ?? null)) {
            echo "hide";
        }
        echo "\" id=\"albums_select_block";
        echo ($context["rand"] ?? null);
        echo "\">
                        <label>
                            ";
        // line 50
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("albums"        ,"media"        ,        );
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
                        <div id=\"albums_select";
        // line 52
        echo ($context["rand"] ?? null);
        echo "\">
                            <select class=\"form-control input-sm\" name=\"album_id\">
                                <option value=\"0\">
                                    ";
        // line 55
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("please_select"        ,"media"        ,        );
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
        echo "                                </option>
                                ";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["user_albums"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 58
            echo "                                    <option value=\"";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" ";
            if (($this->getAttribute($context["item"], "id", []) == ($context["id_album"] ?? null))) {
                echo "selected";
            }
            echo ">
                                        ";
            // line 59
            echo $this->getAttribute($context["item"], "name", []);
            echo "
                                    </option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "                            </select>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <a class=\"btn btn-secondary btn-sm\" id=\"create_album_button_aform";
        // line 66
        echo ($context["rand"] ?? null);
        echo "\" href=\"javascript:void(0);\">
                            ";
        // line 67
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("create_album"        ,"media"        ,        );
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
        echo "                        </a>
                        <span class=\"hide form-inline\" id=\"create_album_container_aform";
        // line 69
        echo ($context["rand"] ?? null);
        echo "\">
                            <span class=\"form-group\">
                                <input class=\"form-control input-sm\" type=\"text\" name=\"album_name\" id=\"album_name_aform";
        // line 71
        echo ($context["rand"] ?? null);
        echo "\">
                            </span>
                            <span class=\"form-group\">
                                <span class=\"btn btn-primary btn-sm\" id=\"save_album_aform";
        // line 74
        echo ($context["rand"] ?? null);
        echo "\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_apply"        ,"start"        ,        );
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
                            </span>
                        </span>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label>
                        ";
        // line 81
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_permitted_for"        ,"media"        ,        );
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
                    ";
        // line 83
        $module =         null;
        $helper =         'lang';
        $name =         'ld';
        $params = array("permissions"        ,"media"        ,        );
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
        // line 84
        echo "                    <select class=\"form-control input-sm\" name=\"permissions\">
                        ";
        // line 85
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["ld_permissions"] ?? null), "option", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 86
            echo "                        ";
            if ((($context["module_frendlist"] ?? null) == false)) {
                // line 87
                echo "                            ";
                if (($context["key"] != 2)) {
                    // line 88
                    echo "                                <option value=\"";
                    echo $context["key"];
                    echo "\"";
                    if (($context["key"] == 4)) {
                        echo " selected";
                    }
                    echo ">";
                    echo $context["item"];
                    echo "</option>
                            ";
                }
                // line 90
                echo "                        ";
            } else {
                // line 91
                echo "                                <option value=\"";
                echo $context["key"];
                echo "\"";
                if (($context["key"] == 4)) {
                    echo " selected";
                }
                echo ">";
                echo $context["item"];
                echo "</option>
                        ";
            }
            // line 93
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        echo "                    </select>
                </div>
                <div class=\"form-group\">
                    <label>
                        ";
        // line 98
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_description"        ,"media"        ,        );
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
                    <textarea class=\"form-control\" rows=\"2\" name=\"description\">";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "description", []));
        echo "</textarea>
                </div>
                <button name=\"btn_upload\" id=\"btn_upload";
        // line 102
        echo ($context["rand"] ?? null);
        echo "\" class=\"btn btn-primary btn-block\">
                    ";
        // line 103
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,""        ,"button"        ,        );
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
        echo "                </button>
            </div>
        </form>
    </div>
    <div class=\"clr\"></div>
</div>

";
        // line 112
        echo "    <script type=\"text/javascript\">
        \$(function () {
            loadScripts(
                    [
                        \"";
        // line 116
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
                        \"";
        // line 117
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("media"        ,"albums.js"        ,"path"        ,        );
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
                        var lang_data = {
                            data: {
                                description: \"";
        // line 122
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_description"        ,"media"        ,        );
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
                            errors: {
                                file_missing: \"";
        // line 125
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
                        };
                        var allowed_mimes = ";
        // line 128
        echo twig_jsonencode_filter($this->getAttribute(($context["media_config"] ?? null), "allowed_mimes", []));
        echo ";
                            mu = new uploader({
                                siteUrl: site_url,
                                Accept: 'application/json',
                                uploadUrl: 'media/save_image',
                                zoneId: 'dndfiles";
        // line 133
        echo ($context["rand"] ?? null);
        echo "',
                                fileId: 'multiUpload";
        // line 134
        echo ($context["rand"] ?? null);
        echo "',
                                formId: 'item_form";
        // line 135
        echo ($context["rand"] ?? null);
        echo "',
                                sendType: 'file',
                                sendId: 'btn_upload";
        // line 137
        echo ($context["rand"] ?? null);
        echo "',
                                messageId: 'attach-input-error";
        // line 138
        echo ($context["rand"] ?? null);
        echo "',
                                warningId: 'attach-input-warning";
        // line 139
        echo ($context["rand"] ?? null);
        echo "',
                                maxFileSize: '";
        // line 140
        echo $this->getAttribute(($context["media_config"] ?? null), "max_size", []);
        echo "',
                                mimeType: allowed_mimes,
                                lang: lang_data,
                                langs: {
                                        exceeded: \"";
        // line 144
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
        // line 145
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
                                cbOnComplete: function (data) {
                                    if (typeof (data.error) !== 'undefined' && data.error.length !== 0) {
                                        error_object.show_error_block(data.error, 'error');
                                    }                                  
                                },
                                cbOnQueueComplete: function (data) {
                                    if (typeof data !== 'undefined') {                                        
                                        if (window.sitegallery) {
                                            sitegallery.reload();
                                            mediagallery.properties.windowObj.hide_load_block();
                                        } else if (window.mediagallery) {
                                            mediagallery.reload();
                                            mediagallery.properties.windowObj.hide_load_block();
                                        }
                                        
                                        if (window.mediaphoto) {
                                            mediaphoto.properties.windowObj.hide_load_block();
                                        }

                                        if (window.recent_mediagallery) {
                                            recent_mediagallery.refresh_recent_photos();
                                        }
                                        if (window.wall) {
                                            wall.loadEvents('new');
                                        }
                                    }
                                },
                                createThumb: true,
                                thumbWidth: 200,
                                thumbHeight: 200,
                                thumbCrop: false,
                                thumbJpeg: false,
                                thumbBg: 'transparent',
                                fileListInZone: false,
                                filebarHeight: 200,
                                jqueryFormPluginUrl: \"";
        // line 182
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
        echo "\",
                                displayFileRow: true,
                                displayAfterProcess: true,
                            });
                        albums_obj = new albums({
                            siteUrl: site_url,
                            contentDiv: '#album_content";
        // line 188
        echo ($context["rand"] ?? null);
        echo "',
                            createAlbumButton: '#create_album_button_aform";
        // line 189
        echo ($context["rand"] ?? null);
        echo "',
                            createAlbumContainer: '#create_album_container_aform";
        // line 190
        echo ($context["rand"] ?? null);
        echo "',
                            saveAlbumButton: '#save_album_aform";
        // line 191
        echo ($context["rand"] ?? null);
        echo "',
                            albumNameInput: '#album_name_aform";
        // line 192
        echo ($context["rand"] ?? null);
        echo "',
                            create_album_success_request: function (resp) {
                                if (resp.status) {
                                    \$('#albums_select";
        // line 195
        echo ($context["rand"] ?? null);
        echo "').html(resp.data.albums_select);
                                    \$('#albums_select";
        // line 196
        echo ($context["rand"] ?? null);
        echo " select').val(resp.data.album_id).prop('selected', 'selected')
                                    \$('#albums_select";
        // line 197
        echo ($context["rand"] ?? null);
        echo " select').addClass('wp100').addClass('box-sizing');
                                    \$('#albums_select_block";
        // line 198
        echo ($context["rand"] ?? null);
        echo "').removeClass('hide');

                                    if (mediagallery) {
                                        mediagallery.properties.galleryContentPage = 1,
                                                mediagallery.properties.all_loaded = 0;
                                        mediagallery.load_content(1);
                                        if (resp.data.albums_select && mediagallery.properties.idUser === resp.data.id_user) {
                                            var selected_album = \$(mediagallery.properties.albumSelector).val();
                                            \$(mediagallery.properties.albumSelectorContainer)
                                                    .html(resp.data.albums_select)
                                                    .val(selected_album)
                                                    .prop('selected', 'selected');
                                        }
                                    }
                                } else {
                                    error_object.show_error_block(resp.errors, 'error');
                                }
                            }
                        });
                    },
                    ['mu', 'albums_obj'],
                    {async: false}
            );
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "add_photos.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  847 => 198,  843 => 197,  839 => 196,  835 => 195,  829 => 192,  825 => 191,  821 => 190,  817 => 189,  813 => 188,  785 => 182,  726 => 145,  703 => 144,  696 => 140,  692 => 139,  688 => 138,  684 => 137,  679 => 135,  675 => 134,  671 => 133,  663 => 128,  638 => 125,  613 => 122,  586 => 117,  563 => 116,  557 => 112,  548 => 104,  527 => 103,  523 => 102,  518 => 100,  494 => 98,  488 => 94,  482 => 93,  470 => 91,  467 => 90,  455 => 88,  452 => 87,  449 => 86,  445 => 85,  442 => 84,  421 => 83,  397 => 81,  366 => 74,  360 => 71,  355 => 69,  352 => 68,  331 => 67,  327 => 66,  321 => 62,  312 => 59,  303 => 58,  299 => 57,  296 => 56,  275 => 55,  269 => 52,  245 => 50,  236 => 48,  232 => 47,  225 => 43,  221 => 42,  217 => 40,  214 => 39,  192 => 38,  170 => 37,  168 => 36,  139 => 29,  133 => 25,  112 => 24,  105 => 20,  102 => 19,  81 => 18,  73 => 13,  69 => 12,  61 => 7,  57 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "add_photos.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/add_photos.twig");
    }
}
