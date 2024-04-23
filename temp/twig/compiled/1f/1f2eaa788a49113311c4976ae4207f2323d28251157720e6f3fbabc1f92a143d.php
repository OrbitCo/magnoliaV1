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

/* settings.twig */
class __TwigTemplate_56954df0b56f0e39a343c14eed2a24064f410195427cf103a88a3fa21d75d429 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "settings.twig", 1)->display($context);
        // line 2
        echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 6
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_news_menu"        ,        );
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
        // line 7
        echo "            </ul>
        </div>
        <div class=\"x_content\">
            <form method=\"post\" enctype=\"multipart/form-data\" data-parsley-validate
                  class=\"form-horizontal form-label-left\" name=\"save_form\"
                  action=\"";
        // line 12
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\">
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 15
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_userside_items"        ,"news"        ,        );
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
                        <input type=\"text\" value=\"";
        // line 17
        echo $this->getAttribute(($context["data"] ?? null), "userside_items_per_page", []);
        echo "\" name=\"userside_items_per_page\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 22
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_userhelper_items"        ,"news"        ,        );
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
                        <input type=\"text\" value=\"";
        // line 24
        echo $this->getAttribute(($context["data"] ?? null), "userhelper_items_per_page", []);
        echo "\" name=\"userhelper_items_per_page\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 29
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_news_max_count"        ,"news"        ,        );
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
                        <input type=\"text\" value=\"";
        // line 31
        echo $this->getAttribute(($context["data"] ?? null), "rss_news_max_count", []);
        echo "\" name=\"rss_news_max_count\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 36
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_use_feeds_news"        ,"news"        ,        );
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
                        <input type=\"text\" value=\"";
        // line 38
        echo $this->getAttribute(($context["data"] ?? null), "rss_use_feeds_news", []);
        echo "\" name=\"rss_use_feeds_news\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 43
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_channel_title"        ,"news"        ,        );
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
                        <input type=\"text\" value=\"";
        // line 45
        echo $this->getAttribute(($context["data"] ?? null), "rss_feed_channel_title", []);
        echo "\" name=\"rss_feed_channel_title\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 50
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_channel_description"        ,"news"        ,        );
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
                        <input type=\"text\" value=\"";
        // line 52
        echo $this->getAttribute(($context["data"] ?? null), "rss_feed_channel_description", []);
        echo "\" name=\"rss_feed_channel_description\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 57
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_image_title"        ,"news"        ,        );
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
                        <input type=\"text\" value=\"";
        // line 59
        echo $this->getAttribute(($context["data"] ?? null), "rss_feed_image_title", []);
        echo "\" name=\"rss_feed_image_title\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 64
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_settings_rss_image_url"        ,"news"        ,        );
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
                        <input type=\"file\" name=\"rss_logo\" class=\"form-control\">
                    ";
        // line 67
        if ($this->getAttribute(($context["data"] ?? null), "rss_feed_image_url", [])) {
            // line 68
            echo "                        <br><img src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "rss_feed_image_media", []), "thumbs", []), "rss", []);
            echo "\"  hspace=\"2\" vspace=\"2\" />
                        <br><input type=\"checkbox\" name=\"rss_logo_delete\" value=\"1\" id=\"uichb\" class=\"flat\">
                        <label for=\"uichb\">";
            // line 70
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_icon_delete"            ,"news"            ,            );
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
                    ";
        }
        // line 72
        echo "                    </div>
                </div>
                <div class=\"ln_solid\"></div>
                <div class=\"form-group\">
                    <div class=\"col-md-9 col-sm-9 col-xs-12 col-md-offset-3 col-sm-offset-3\">
                        <input type=\"submit\" name=\"btn_save\" value=\"";
        // line 77
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
        echo "\" class=\"btn btn-success\">
                        <a class=\"btn btn-default\" href=\"";
        // line 78
        echo ($context["site_url"] ?? null);
        echo "admin/start/menu/content_items\">";
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

";
        // line 87
        $this->loadTemplate("@app/footer.twig", "settings.twig", 87)->display($context);
    }

    public function getTemplateName()
    {
        return "settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  416 => 87,  383 => 78,  360 => 77,  353 => 72,  329 => 70,  323 => 68,  321 => 67,  296 => 64,  288 => 59,  264 => 57,  256 => 52,  232 => 50,  224 => 45,  200 => 43,  192 => 38,  168 => 36,  160 => 31,  136 => 29,  128 => 24,  104 => 22,  96 => 17,  72 => 15,  66 => 12,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "settings.twig", "/home/mliadov/public_html/application/modules/news/views/gentelella/settings.twig");
    }
}
