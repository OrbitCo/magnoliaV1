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

/* helper_active_users_block.twig */
class __TwigTemplate_470d457fd4b4a2a77926a12b764c4da5da179206eefa161b0085272c7ff8f9d8 extends \Twig\Template
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
        $context["thumb_name"] = $this->getAttribute(($context["recent_thumb"] ?? null), "name", []);
        // line 2
        echo "<div class=\"active-users clearfix\" id=\"active_users_inner\">
    <div  class=\"title-block\" data-title=\"";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_active_users"        ,"users"        ,        );
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
        echo "\" data-id=\"active-user-title\" id=\"active-user-title\">
        <span>
            ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_active_users"        ,"users"        ,        );
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
        echo "        </span>
        <span class=\"fright refresh_active_users\" id=\"refresh_active_users\">
            <i class=\"fas fa-sync\"></i>
        </span>
    </div>
    <div class=\"active-users-filter-wrapper\">
        <a href=\"javascript:void(0);\" class=\"refresh_active_users active-users-filter ";
        // line 12
        if ( !($context["active_user_type"] ?? null)) {
            echo "selected";
        }
        echo "\" user_type=\"0\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_all"        ,"users"        ,        );
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
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["user_types"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["user_type"]) {
            // line 14
            echo "            &nbsp;<a href=\"javascript:void(0);\" class=\"refresh_active_users active-users-filter";
            if (($context["key"] == ($context["active_user_type"] ?? null))) {
                echo " selected";
            }
            echo "\" user_type=\"";
            echo $context["key"];
            echo "\">";
            echo $context["user_type"];
            echo "</a>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['user_type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "    </div>
    <div class=\"clearfix\"></div>
    ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["active_users_block_data"] ?? null), "users", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 19
            echo "      <div class=\"fleft\">
        <a data-action=\"set_user_ids\" data-gid=\"active_users\" data-href=\"";
            // line 20
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["item"] ?? null)            ,            );
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
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["item"] ?? null)            ,            );
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
            // line 21
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => ($context["item"] ?? null), "size" => "small", "class" => "small", "file_width" => "{{ recent_thumb.width }}"]            ,            );
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
            // line 22
            echo "        </a>
      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "</div>
<script>
    \$(function () {

        \$('.refresh_active_users').unbind('click').click(function () {
            var user_type;
            if (\$(this).hasClass('active-users-filter')) {
                user_type = \$(this).attr('user_type');
            } else {
                user_type = \$('.active-users-filter.selected').attr('user_type');
            }

            \$.ajax({
                url: site_url + 'users/ajax_refresh_active_users',
                type: 'POST',
                data: {count: 16, \"user_type\": user_type},
                dataType: \"html\",
                cache: false,
                success: function (data) {
                    \$('#active_users').html(data);
                }
            });
            return false;
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_active_users_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  218 => 25,  210 => 22,  189 => 21,  145 => 20,  142 => 19,  138 => 18,  134 => 16,  119 => 14,  115 => 13,  88 => 12,  80 => 6,  59 => 5,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_active_users_block.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_active_users_block.twig");
    }
}
