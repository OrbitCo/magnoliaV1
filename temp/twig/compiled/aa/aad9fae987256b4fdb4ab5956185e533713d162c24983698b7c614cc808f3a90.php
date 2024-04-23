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

/* helper_auth_links.twig */
class __TwigTemplate_70f85594e88467b59531530735b3c874bb888e38343be8ccc09339a6f624de22 extends \Twig\Template
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
        if ((($context["auth_type"] ?? null) == "user")) {
            // line 2
            echo "  ";
            if ( !($context["is_mobile"] ?? null)) {
                // line 3
                echo "    <div class=\"user_quick_menu hidden-xs\">
      <a id=\"users_link_profile\" href=\"javascript:void(0);\" class=\"user-link-profile\"
         data-target=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" role=\"button\"
         aria-expanded=\"false\"
         onclick=\"";
                // line 7
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("right_top_menu"                ,"my-profile-item"                ,                );
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
                // line 8
                $module =                 null;
                $helper =                 'users';
                $name =                 'formatAvatar';
                $params = array(["user" => ["media" => $this->getAttribute(($context["user_session_data"] ?? null), "logo", [])], "size" => "small", "class" => "img-rounded"]                ,                );
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
                // line 9
                echo "        <span class=\"badge sidebar-sum hide-always\"></span>
      </a>
      <div class=\"dropdown-menu settings_menu-top_menu\" role=\"menu\" aria-labelledby=\"users_link_profile\">
        <div class=\"menu-more-triangle\"></div>
        ";
                // line 13
                $module =                 null;
                $helper =                 'menu';
                $name =                 'get_menu';
                $params = array("settings_menu"                ,"settings_menu"                ,                );
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
                echo "      </div>
    </div>
  ";
            }
            // line 17
            echo "  <div class=\"user_quick_menu visible-xs-block\">
    <a href=\"";
            // line 18
            echo ($context["site_url"] ?? null);
            echo "users/view/";
            echo $this->getAttribute(($context["user_session_data"] ?? null), "user_id", []);
            echo "/profile\"
       onclick=\"";
            // line 19
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("right_top_menu"            ,"my-profile-item"            ,            );
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
            // line 20
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => ["media" => $this->getAttribute(($context["user_session_data"] ?? null), "logo", [])], "size" => "small", "class" => "img-rounded"]            ,            );
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
            echo "    </a>
  </div>
";
        } else {
            // line 24
            echo "  <a href=\"javascript:void(0);\" id=\"ajax_login_link\" class=\"top-menu-item\">
    ";
            // line 25
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_login"            ,"users"            ,            );
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
            // line 26
            echo "  </a>
  <script>
    \$(function () {
      loadScripts(
        [\"";
            // line 30
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("users"            ,"users-auth.js"            ,"path"            ,            );
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
            echo "\"],
        function () {
          usersAuth = new UsersAuth({
            siteUrl: site_url
          });
        },
        ['usersAuth'],
        {async: true}
      );
    });
  </script>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_auth_links.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 30,  199 => 26,  178 => 25,  175 => 24,  170 => 21,  149 => 20,  126 => 19,  120 => 18,  117 => 17,  112 => 14,  91 => 13,  85 => 9,  64 => 8,  41 => 7,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_auth_links.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\helper_auth_links.twig");
    }
}
