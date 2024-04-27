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

/* helper_mark_as_spam_link.twig */
class __TwigTemplate_8a4f685a063334db9c2890aff2474b3bde3c6f8a2fbc71587e941de9afca3c77 extends \Twig\Template
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
        echo "<span class=\"user-menu-item\" id=\"mark-as-spam-";
        echo ($context["rand"] ?? null);
        echo "\">
  <a onclick=\"";
        // line 2
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("user_profile"        ,"btn_report"        ,        );
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
        echo "\" href=\"javascript:;\" data-id=\"";
        echo ($context["object_id"] ?? null);
        echo "\" data-type=\"";
        echo $this->getAttribute(($context["type"] ?? null), "gid", []);
        echo "\">
    ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_mark_as_spam"        ,"spam"        ,        );
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
        echo "  </a>
</span>
<script>
  \$(function() {
    loadScripts(
      \"";
        // line 9
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("spam"        ,"spam.js"        ,"path"        ,        );
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
        spam = new Spam({
          siteUrl: '";
        // line 12
        echo ($context["site_root"] ?? null);
        echo "',
          use_form: ";
        // line 13
        if (($this->getAttribute(($context["type"] ?? null), "form_type", []) != "checkbox")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
          ";
        // line 14
        if ( !twig_test_empty(($context["is_spam_owner"] ?? null))) {
            echo "isOwner: true,";
        }
        // line 15
        echo "          is_send: '";
        echo ($context["is_send"] ?? null);
        echo "',
          error_is_send: '";
        // line 16
        ob_start(function () { return ''; });
        // line 17
        echo "          ";
        if (($context["is_guest"] ?? null)) {
            // line 18
            echo "          ajax_login_link
          ";
        } else {
            // line 20
            echo "          ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array(("error_is_send_" . $this->getAttribute(($context["type"] ?? null), "gid", []))            ,"spam"            ,""            ,"js"            ,            );
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
            echo "          ";
        }
        // line 22
        echo "          ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "',
          mark_as_spam_btn: 'mark-as-spam-";
        // line 23
        echo ($context["rand"] ?? null);
        echo " a',
          markAsSpamId: '#mark-as-spam-";
        // line 24
        echo ($context["rand"] ?? null);
        echo "',
          mark_as_spam_link: '',
        });
      },
      ''
    );
  })
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_mark_as_spam_link.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 24,  175 => 23,  170 => 22,  167 => 21,  145 => 20,  141 => 18,  138 => 17,  136 => 16,  131 => 15,  127 => 14,  119 => 13,  115 => 12,  90 => 9,  83 => 4,  62 => 3,  35 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_mark_as_spam_link.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\spam\\views\\flatty\\helper_mark_as_spam_link.twig");
    }
}
