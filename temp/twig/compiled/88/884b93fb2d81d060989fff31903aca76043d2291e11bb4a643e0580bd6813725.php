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

/* default_list.twig */
class __TwigTemplate_dda9a2580d0782de3dab59c3f23afa1077adc7d04c87473af93ed31c2f09f97f extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "default_list.twig", 1)->display($context);
        // line 2
        echo "<div class=\"x_panel\">
    <div class=\"x_content\">
        <ul class=\"nav nav-tabs bar_tabs\">
            ";
        // line 5
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_seo_menu"        ,        );
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
        // line 6
        echo "          </ul>
    </div>
    <div class=\"x_content\">
        <table id=\"data\" class=\"table table-striped jambo_table\">
            <thead>
                <tr class=\"headings\">
                    <th class=\"column-title\">";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("settings_name_field"        ,"seo"        ,        );
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
        echo "</th>
                    <th class=\"column-title\">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("default_seo_admin_field"        ,"seo"        ,        );
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
        echo "</td>
                    <td class=\"icons\">
                      <div class=\"btn-group\">
                        <a onclick=\"";
        // line 21
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("seo"        ,"btn_edit_admin"        ,        );
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
        echo "\" href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/seo/default_edit/admin\" title=\"";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
                           class=\"btn btn-primary\">
                            ";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
        echo "                        </a>
                        <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                aria-haspopup=\"true\" aria-expanded=\"false\">
                          <span class=\"caret\"></span>
                          <span class=\"sr-only\">Toggle Dropdown</span>
                        </button>
                        <ul class=\"dropdown-menu\">
                          <li onclick=\"";
        // line 31
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("seo"        ,"btn_edit_admin"        ,        );
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
                            <a href=\"";
        // line 32
        echo ($context["site_url"] ?? null);
        echo "admin/seo/default_edit/admin\"
                               title=\"";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
        // line 34
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
        // line 35
        echo "                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                </tr>
                <tr>
                    <td>";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("default_seo_user_field"        ,"seo"        ,        );
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
        echo "</td>
                    <td class=\"icons\">
                      <div class=\"btn-group\">
                        <a onclick=\"";
        // line 45
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("seo"        ,"btn_edit_user"        ,        );
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
        echo "\" href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/seo/default_edit/user\" title=\"";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
                           class=\"btn btn-primary\">
                            ";
        // line 47
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
        // line 48
        echo "                        </a>
                        <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                aria-haspopup=\"true\" aria-expanded=\"false\">
                          <span class=\"caret\"></span>
                          <span class=\"sr-only\">Toggle Dropdown</span>
                        </button>
                        <ul class=\"dropdown-menu\">
                          <li onclick=\"";
        // line 55
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("seo"        ,"btn_edit_user"        ,        );
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
                            <a href=\"";
        // line 56
        echo ($context["site_url"] ?? null);
        echo "admin/seo/default_edit/user\"
                               title=\"";
        // line 57
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
        // line 58
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_edit_settings"        ,"seo"        ,        );
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
        // line 59
        echo "                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
        ";
        // line 67
        $this->loadTemplate("@app/pagination.twig", "default_list.twig", 67)->display($context);
        // line 68
        echo "    </div>
</div>

";
        // line 71
        $this->loadTemplate("@app/footer.twig", "default_list.twig", 71)->display($context);
    }

    public function getTemplateName()
    {
        return "default_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  466 => 71,  461 => 68,  459 => 67,  449 => 59,  428 => 58,  405 => 57,  401 => 56,  378 => 55,  369 => 48,  348 => 47,  301 => 45,  276 => 42,  267 => 35,  246 => 34,  223 => 33,  219 => 32,  196 => 31,  187 => 24,  166 => 23,  119 => 21,  94 => 18,  66 => 12,  58 => 6,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "default_list.twig", "/home/mliadov/public_html/application/modules/seo/views/gentelella/default_list.twig");
    }
}
