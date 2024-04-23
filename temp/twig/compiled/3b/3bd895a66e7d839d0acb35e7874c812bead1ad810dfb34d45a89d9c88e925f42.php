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

/* helper_wall.twig */
class __TwigTemplate_0cbc077385e354c444e1e6faa8e1cdcf03904b2924e602273bd1d33b6d6e3735 extends \Twig\Template
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
        echo "<div class=\"dashboard-visibility-btn\" id=\"dashboard-visibility-btn\">
  <div class=\"dashboard-minimized-js\">
    <div>";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_dashboard"        ,"dashboard"        ,        );
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
    <div><i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i></div>
  </div>
</div>
<div onclick=\"";
        // line 7
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("dashboard"        ,"wall"        ,        );
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
        echo "\" id=\"dashboard\" class=\"dashboard\">
  <div class=\"dashboard-deployed-js dashboard-visibility-btn\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></div>
  <div class=\"dashboard__content x_panel\">
    <div class=\"x_title row\" data-action=\"top\">
      <h2>";
        // line 11
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_dashboard"        ,"dashboard"        ,        );
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
        echo "</h2>
    </div>
    <div class=\"x_content\">
      <ul class=\"list\">
        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["events"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 16
            echo "          <li data-action=\"event\" data-id=\"";
            echo $this->getAttribute($context["event"], "id", []);
            echo "\" id=\"event-block-";
            echo $this->getAttribute($context["event"], "id", []);
            echo "\">
            <div class=\"panel panel-custom\">
              <div class=\"panel-heading\">
                <div class=\"dashboard__date\">
                  ";
            // line 20
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["event"] ?? null), "date_modified", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])            ,            );
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
                <h5 class=\"dashboard__title\">
                  <a href=\"";
            // line 22
            echo ($context["site_url"] ?? null);
            echo $this->getAttribute($this->getAttribute($context["event"], "data", []), "dashboard_action_link", []);
            echo "\" target=\"_blank\">
                    ";
            // line 23
            if ( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($context["event"], "data", []), "type", []), "module", []))) {
                // line 24
                echo "                      ";
                $context["module"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["event"], "data", []), "type", []), "module", []);
                // line 25
                echo "                    ";
            } else {
                // line 26
                echo "                      ";
                $context["module"] = $this->getAttribute($context["event"], "module", []);
                // line 27
                echo "                    ";
            }
            // line 28
            echo "
                    ";
            // line 29
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array($this->getAttribute($this->getAttribute(($context["event"] ?? null), "data", []), "dashboard_header", [])            ,($context["module"] ?? null)            ,            );
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
                </h5>
                <div class=\"clearfix\"></div>
              </div>
              <div class=\"panel-body\">
                ";
            // line 34
            echo $this->getAttribute($this->getAttribute($context["event"], "data", []), "content", []);
            echo "
              </div>
            </div>
          </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "      </ul>
    </div>
  </div>
  <div id=\"scroll-top\" class=\"dashboard__scroll-top\">
    <i class=\"fa fa-chevron-up pointer\"></i>
  </div>
  ";
        // line 45
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("dashboard"        ,"dashboardAdmin.js"        ,        );
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
        // line 46
        echo "  <script>
    \$(function () {
      new dashboardAdmin({
        siteUrl: site_url,
        cookiePath: '";
        // line 50
        echo ($context["cookie_site_path"] ?? null);
        echo "',
        cookieDomain: '";
        // line 51
        echo ($context["cookie_site_server"] ?? null);
        echo "',
        id: {
          dashboard: '#dashboard',
          topNav: '#top_nav',
          scrollTop: '#scroll-top',
          eventBlock: '#event-block-',
          dashboardVisibilityBtn: '#dashboard-visibility-btn'
        },
        cssClass: {
          dashboardAction: '.js-dashboard-action',
          dashboardDeployed: '.dashboard-deployed-js',
          dashboardMinimized: '.dashboard-minimized-js',
          quickStats: '.quick-stats-js',
          dashboardVisibilityBtn: '.dashboard-visibility-btn'
        },
        dataAction: {
          event: '[data-action=\"event\"]',
          top: '[data-action=\"top\"]'
        },
        langs: {
          moderation:{
            confirm: '";
        // line 72
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_confirm"        ,"media"        ,        );
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
            headerReason: '";
        // line 73
        $module =         null;
        $helper =         'lang';
        $name =         'ld_header';
        $params = array("rejection_reason"        ,"moderation"        ,        );
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
            emptyReason: '";
        // line 74
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_empty_reason"        ,"users"        ,        );
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
            rejectionReason: ";
        // line 75
        echo twig_jsonencode_filter($this->getAttribute(($context["rejection_reason"] ?? null), "option", []));
        echo "
          },
        },
        trial: ";
        // line 78
        if (($context["TRIAL_MODE"] ?? null)) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
        contentObj: new loadingContent({
          loadBlockWidth: '50%',
          footerButtons: '<a class=\"btn btn-primary btn-moder-action-js\" href=\"#\">";
        // line 81
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_confirm"        ,"media"        ,        );
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
        echo "</a>'
        })
      });
    });
  </script>
</div>
";
    }

    public function getTemplateName()
    {
        return "helper_wall.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  358 => 81,  348 => 78,  342 => 75,  319 => 74,  296 => 73,  273 => 72,  249 => 51,  245 => 50,  239 => 46,  218 => 45,  210 => 39,  199 => 34,  172 => 29,  169 => 28,  166 => 27,  163 => 26,  160 => 25,  157 => 24,  155 => 23,  150 => 22,  126 => 20,  116 => 16,  112 => 15,  86 => 11,  60 => 7,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_wall.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\dashboard\\views\\gentelella\\helper_wall.twig");
    }
}
