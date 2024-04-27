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

/* helper_blacklist_link.twig */
class __TwigTemplate_bcf2cf25d1fb4d1815ff5168935c954e2d22dbbf418f1db59b192a9bf9ab3a92 extends \Twig\Template
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
        echo "<span class=\"user-menu-item\">
    <span id=\"block_user_";
        // line 2
        echo ($context["id_dest_user"] ?? null);
        echo "\">

        <a class=\"";
        // line 4
        if ((($context["action"] ?? null) == "remove")) {
            echo " hide";
        }
        echo " link-r-margin add_to_blacklist\"
           data-userId=\"";
        // line 5
        echo ($context["id_dest_user"] ?? null);
        echo "\"
           href=\"";
        // line 6
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("blacklist"        ,"add"        ,($context["id_dest_user"] ?? null)        ,        );
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
           data-pjax=\"0\" onclick=\"";
        // line 7
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("user_profile"        ,"btn_add_to_blacklist"        ,        );
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
        echo " event.preventDefault();\"
           title=\"";
        // line 8
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_add"        ,"blacklist"        ,        );
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
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_add"        ,"blacklist"        ,        );
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
        // line 10
        echo "        </a>

        <a class=\"";
        // line 12
        if ((($context["action"] ?? null) == "add")) {
            echo "hide";
        }
        echo " link-r-margin remove_from_blacklist\"
           href=\"";
        // line 13
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("blacklist"        ,"remove"        ,($context["id_dest_user"] ?? null)        ,        );
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
        echo "\" data-userId=\"";
        echo ($context["id_dest_user"] ?? null);
        echo "\"
           data-pjax=\"0\" onclick=\"event.preventDefault();\"
           title=\"";
        // line 15
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_remove"        ,"blacklist"        ,        );
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
        // line 16
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_remove"        ,"blacklist"        ,        );
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
        // line 17
        echo "        </a>
    </span>
</span>
<script>
  \$(function () {
    loadScripts(
      [\"";
        // line 23
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("blacklist"        ,"blacklist.js"        ,"path"        ,        );
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
        blacklistObj = new blacklist({
          siteUrl: site_url
        });
      },
      'blacklistObj'
    );
  });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_blacklist_link.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 23,  218 => 17,  197 => 16,  174 => 15,  148 => 13,  142 => 12,  138 => 10,  117 => 9,  94 => 8,  71 => 7,  48 => 6,  44 => 5,  38 => 4,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_blacklist_link.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\blacklist\\views\\flatty\\helper_blacklist_link.twig");
    }
}
