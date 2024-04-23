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

/* ajax_user_select_form.twig */
class __TwigTemplate_995bb4ae6e49e4e938d31999f51e0e925f47ad718a53bf893fa110296d26b5e1 extends \Twig\Template
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
        echo "<div class=\"content-block event-view horizontal\">
  <h1>";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_add_contact"        ,"chatbox"        ,        );
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
        echo "</h1>
  <div class=\"user-search\">
    <div class=\"search-param-button mb10\"><a>";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_params_button"        ,"users"        ,        );
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
        echo "</a></div>
    <div class=\"search-form\">
      ";
        // line 6
        $module =         null;
        $helper =         'utils';
        $name =         'startSearchForm';
        $params = array(["type" => "advanced", "show_data" => "0", "object" => "user", "params_data" => ["view" => "default", "hide_popup" => 1, "search_url" => "chatbox/ajax_search_users/"]]        ,        );
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
        // line 16
        echo "    </div>
    <div class=\"search-result\" id=\"main_users_results\">
      ";
        // line 18
        echo ($context["users_block"] ?? null);
        echo "
    </div>
  </div>
</div>
<style type=\"text/css\">
  .dropdown_location {
    z-index: 99999 !important;
  }
</style>

<script>
  \$(function () {
    \$('.search-param-button').click(function () {
      \$('.user-search .search-form').toggle()
    })
  })
</script>
";
    }

    public function getTemplateName()
    {
        return "ajax_user_select_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 18,  102 => 16,  81 => 6,  57 => 4,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_user_select_form.twig", "/home/mliadov/public_html/application/modules/chatbox/views/flatty/ajax_user_select_form.twig");
    }
}
