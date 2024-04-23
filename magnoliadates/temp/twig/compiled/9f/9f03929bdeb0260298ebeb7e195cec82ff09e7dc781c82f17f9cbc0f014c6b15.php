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

/* add_video.twig */
class __TwigTemplate_21fbe19e6aa6ec301d86fd3833f95aec387bd2a9fdb71b5e457ff39ef9bd8e5c extends \Twig\Template
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
        echo "<div class=\"content-block load_content\">
    <h1>
        ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_video"        ,"media"        ,        );
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
        // line 4
        echo "    </h1>

    <div class=\"m10 oh popup-form\">
        <form id=\"upload_video\" action=\"";
        // line 7
        echo ($context["site_url"] ?? null);
        echo "media/save_video\"
              method=\"post\" name=\"upload_video\"
              enctype=\"multipart/form-data\">
            <div class=\"form-group\">
                <div class=\"f-title\">
                    ";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_files"        ,"media"        ,        );
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
                <div class=\"f-block\">
                    <input type=\"file\" class=\"form-control\" name=\"videofile\" multiple id=\"videofile\" />(
                    ";
        // line 16
        if (($this->getAttribute(($context["media_config"] ?? null), "max_size", []) == "0")) {
            // line 17
            echo "                        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("int_unlimited"            ,"uploads"            ,            );
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
            // line 18
            echo "                    ";
        } else {
            // line 19
            echo "                        ";
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
            // line 20
            echo "                        ";
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
            // line 21
            echo "                    ";
        }
        echo ")&nbsp;
                    <span id=\"attach-input-error\"></span>
                    <div id=\"attach-input-warning\"></div>
                </div>
            </div>
            <div class=\"form-group\">
                <div class=\"f-title\">
                    ";
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_or_embed_code"        ,"media"        ,        );
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
        // line 29
        echo "                </div>
                <div class=\"f-block\">
                    <textarea class=\"form-control\" name=\"embed_code\"></textarea>
                </div>
            </div>

            ";
        // line 35
        if (($context["user_albums"] ?? null)) {
            // line 36
            echo "                <div class=\"form-group\">
                    <div class=\"f-title\">
                        ";
            // line 38
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
            echo ":
                    </div>
                    <div class=\"f-block\">
                        <select class=\"form-control input-sm\" name=\"id_album\">
                            <option value=\"0\">
                                ";
            // line 43
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("please_select"            ,"media"            ,            );
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
            // line 44
            echo "                            </option>
                            ";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["user_albums"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 46
                echo "                                <option value=\"";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" ";
                if (($this->getAttribute($context["item"], "id", []) == ($context["id_album"] ?? null))) {
                    echo "selected";
                }
                echo ">
                                    ";
                // line 47
                echo $this->getAttribute($context["item"], "name", []);
                echo "
                                </option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "                        </select>
                    </div>
                </div>
            ";
        }
        // line 54
        echo "
            <div class=\"form-group\">
                <div class=\"f-title\">
                    ";
        // line 57
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
                </div>
                <div class=\"f-block\">
                    ";
        // line 60
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
        // line 61
        echo "                    <select class=\"form-control input-sm\" name=\"permissions\">
                        ";
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["ld_permissions"] ?? null), "option", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 63
            echo "                        ";
            if ((($context["module_frendlist"] ?? null) == false)) {
                // line 64
                echo "                            ";
                if (($context["key"] != 2)) {
                    // line 65
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
                // line 67
                echo "                        ";
            } else {
                // line 68
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
            // line 70
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        echo "                    </select>
                </div>
            </div>

            <div class=\"form-group\">
                <div class=\"f-title\">
                    ";
        // line 77
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
                </div>
                <div class=\"f-block\">
                    <textarea class=\"form-control\" name=\"description\">";
        // line 80
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "description", []));
        echo "</textarea>
                </div>
            </div>

            <button name=\"btn_upload\" id=\"btn_upload\" class=\"btn btn-primary\">
                ";
        // line 85
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,        );
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
        // line 86
        echo "            </button>
        </form>
    </div>
    <div class=\"clr\"></div>
</div>
";
        // line 92
        echo "    <script>
        \$(function () {
            var allowed_mimes = ";
        // line 94
        echo twig_jsonencode_filter($this->getAttribute(($context["media_config"] ?? null), "allowed_mimes", []));
        echo ";
                    loadScripts(
                            \"";
        // line 96
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
        // line 100
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
                                vu = new uploader({
                                    siteUrl: site_url,
                                    Accept: 'application/json',
                                    uploadUrl: 'media/save_video',
                                    //zoneId: 'dragAndDropFiles',
                                    fileId: 'videofile',
                                    formId: 'upload_video',
                                    sendType: 'file',
                                    sendId: 'btn_upload',
                                    //multiFile: false,
                                    messageId: 'attach-input-error',
                                    warningId: 'attach-input-warning',
                                    maxFileSize: '";
        // line 115
        echo $this->getAttribute(($context["media_config"] ?? null), "max_size", []);
        echo "',
                                    mimeType: allowed_mimes,
                                    allowEmptyFile: true,
                                    lang: lang_data,
                                    langs: {
                                        exceeded: \"";
        // line 120
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
        // line 121
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
                                    cbOnUpload: function (name, data) {
                                        if (window.sitegallery) {
                                            sitegallery.reload();
                                        } else if (window.mediagallery) {
                                            mediagallery.reload();
                                        }
                                        if (window.mediagallery) {
                                            mediagallery.properties.windowObj.hide_load_block();
                                        }
                                    },
                                    cbOnComplete: function (data) {
                                        if (typeof (data.error) !== 'undefined' && data.error.length !== 0) {
                                            error_object.show_error_block(data.error, 'error');
                                        }  
                                        \$('#videofile').val('');
                                    },
                                    jqueryFormPluginUrl: \"";
        // line 139
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
        echo "\"
                                });
                            },
                            ['vu'],
                            {async: false}
                    );
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "add_video.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  599 => 139,  559 => 121,  536 => 120,  528 => 115,  491 => 100,  465 => 96,  460 => 94,  456 => 92,  449 => 86,  428 => 85,  420 => 80,  395 => 77,  387 => 71,  381 => 70,  369 => 68,  366 => 67,  354 => 65,  351 => 64,  348 => 63,  344 => 62,  341 => 61,  320 => 60,  295 => 57,  290 => 54,  284 => 50,  275 => 47,  266 => 46,  262 => 45,  259 => 44,  238 => 43,  211 => 38,  207 => 36,  205 => 35,  197 => 29,  176 => 28,  165 => 21,  143 => 20,  121 => 19,  118 => 18,  96 => 17,  94 => 16,  68 => 12,  60 => 7,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "add_video.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/add_video.twig");
    }
}
