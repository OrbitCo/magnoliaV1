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

/* upload.twig */
class __TwigTemplate_66d1e326269574be094e196b940261a06db5921b7bf057a389cd8079beddaeee extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "upload.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"x_content\">
            <form method=\"post\" enctype=\"multipart/form-data\" data-parsley-validate
                  class=\"form-horizontal form-label-left\" name=\"save_form\"
                  action=\"";
        // line 8
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" id=\"item_form\">
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
        // line 11
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("uploaded_gifts_price"        ,"virtual_gifts"        ,        );
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
        echo " (";
        $module =         null;
        $helper =         'start';
        $name =         'currency_format_output';
        $params = array(        );
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
        echo "):</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"number\" name=\"price_reduced\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["price_default"] ?? null));
        echo "\" class=\"form-control\" step=\"0.5\" min=\"0.5\" requared>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("upload_images"        ,"virtual_gifts"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
        // line 24
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("upload_max_image_size"        ,"virtual_gifts"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        ";
        // line 26
        if ($this->getAttribute(($context["photo_config"] ?? null), "max_size", [])) {
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
            $module =             null;
            $helper =             'utils';
            $name =             'bytes_format';
            $params = array($this->getAttribute(($context["photo_config"] ?? null), "max_size", [])            ,            );
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
        }
        // line 27
        echo "                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("upload_max_width_height"        ,"virtual_gifts"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                         ";
        // line 33
        echo $this->getAttribute(($context["photo_config"] ?? null), "max_width", []);
        echo "x";
        echo $this->getAttribute(($context["photo_config"] ?? null), "max_height", []);
        echo "
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
        // line 38
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("upload_file_formats"        ,"virtual_gifts"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        ";
        // line 40
        echo $this->getAttribute(($context["photo_config"] ?? null), "file_formats_str", []);
        echo "
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                      ";
        // line 45
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_upload"        ,"virtual_gifts"        ,        );
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
        echo "</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div id=\"dnd_upload\" class=\"drag\">
                            <div id=\"dndfiles\" class=\"drag-area\">
                                <div class=\"drag\">
                                    <i>";
        // line 50
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("upload_drag_area"        ,"virtual_gifts"        ,        );
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
        echo "</i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class=\"upload-btn\">
                                <span data-role=\"filebutton\">
                                    <input type=\"file\" name=\"multiUpload\" id=\"multiUpload\" multiple class=\"form-control\">
                                </span>
                            </div>
                            &nbsp;<span id=\"attach-input-error\"></span>
                            <div id=\"attach-input-warning\"></div>
                        </div>
                    </div>
                </div>
                <div class=\"ln_solid\"></div>
                <div class=\"form-group\">
                    <div class=\"col-md-9 col-sm-9 col-xs-12 col-sm-offset-3\">
                        <button class=\"btn btn-success\" type=\"button\" value=\"1\" name=\"btn_save\" id=\"btn_mupload\">
                            ";
        // line 69
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_upload"        ,"start"        ,        );
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
        echo "</button>
                        <a class=\"btn btn-default\" href=\"";
        // line 70
        echo ($context["back_url"] ?? null);
        echo "\">
                            ";
        // line 71
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
        echo "</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class=\"clearfix\"></div>
<script type='text/javascript'>
\$(function(){
    loadScripts(
        \"";
        // line 82
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
        function(){
            var photo_mimes = ";
        // line 84
        echo twig_jsonencode_filter($this->getAttribute(($context["photo_config"] ?? null), "allowed_mimes", []));
        echo ";
            var product_id = 1;
            var lang_data = {
                    errors: {
                        file_missing: \"";
        // line 88
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
        echo "\",
                        price_err: \"";
        // line 89
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_price"        ,"virtual_gifts"        ,        );
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
            mu = new uploader({
                Accept: 'application/json',
                siteUrl: site_url,
                uploadUrl: 'admin/virtual_gifts/ajax_save_gift_media/images/'+product_id,
                zoneId: 'dndfiles',
                fileId: 'multiUpload',
                formId: 'item_form',
                sendType: 'file',
                sendId: 'btn_mupload',
                messageId: 'attach-input-error',
                warningId: 'attach-input-warning',
                maxFileSize: '";
        // line 103
        echo $this->getAttribute(($context["photo_config"] ?? null), "max_size", []);
        echo "',
                mimeType:  photo_mimes,
                lang: lang_data,
                langs: {
                        exceeded: \"";
        // line 107
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
        // line 108
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
                cbOnSend: function(){
                    var price = parseInt(\$('input[name=price_reduced]').val());
                    if (price <= 0) {
                        error_object.show_error_block(lang_data.errors.price_err, 'error');
                        return false;
                    } else {
                        mu.send();
                    }
                },
                cbOnQueueComplete: function(data) {
                    if (data.errors) {
                        error_object.show_error_block(data.errors, 'error');
                    } else {
                        window.location.replace(site_url + 'admin/virtual_gifts');
                    }
                },
                createThumb: true,
                thumbWidth: 60,
                thumbHeight: 60,
                thumbCrop: true,
                thumbJpeg: false,
                thumbBg: 'transparent',
                fileListInZone: true,
                filebarHeight: 200,
                jqueryFormPluginUrl: \"";
        // line 134
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
        ['mu'],
        {async: false}
    );
});
</script>

";
        // line 143
        $this->loadTemplate("@app/footer.twig", "upload.twig", 143)->display($context);
    }

    public function getTemplateName()
    {
        return "upload.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  593 => 143,  562 => 134,  514 => 108,  491 => 107,  484 => 103,  448 => 89,  425 => 88,  418 => 84,  394 => 82,  361 => 71,  357 => 70,  334 => 69,  293 => 50,  266 => 45,  258 => 40,  234 => 38,  224 => 33,  200 => 31,  194 => 27,  151 => 26,  127 => 24,  99 => 18,  91 => 13,  46 => 11,  40 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "upload.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/gentelella/upload.twig");
    }
}
