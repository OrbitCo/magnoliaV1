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

/* helper_mark_as_spam_minibutton.twig */
class __TwigTemplate_1b9f6a5925955800c4e6ffd8e2d26324fb75c5d9b7696d41a960f5d81d2c5e63 extends \Twig\Template
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
        echo "<a ";
        if ( !($context["is_send"] ?? null)) {
            echo "href=\"javascript:void(0);\"";
        }
        // line 2
        echo "    data-id=\"";
        echo ($context["object_id"] ?? null);
        echo "\" data-type=\"";
        echo $this->getAttribute(($context["type"] ?? null), "gid", []);
        echo "\"
    id=\"mark-as-span-";
        // line 3
        echo ($context["rand"] ?? null);
        echo "\" class=\"link-r-margin\"
    title=\"";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_mark_as_spam"        ,"spam"        ,""        ,"button"        ,        );
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
    <ins class=\"far fa-flag pr5 ";
        // line 5
        if (($context["is_send"] ?? null)) {
            echo "g";
        }
        echo "\"></ins>
</a>
<script>
  \$(function() {
    loadScripts(
      \"";
        // line 10
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
        // line 13
        echo ($context["site_root"] ?? null);
        echo "',
          use_form: ";
        // line 14
        if (($this->getAttribute(($context["type"] ?? null), "form_type", []) != "checkbox")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
          ";
        // line 15
        if ( !twig_test_empty(($context["is_spam_owner"] ?? null))) {
            echo "isOwner: true,";
        }
        // line 16
        echo "          is_send: '";
        echo ($context["is_send"] ?? null);
        echo "',
          error_is_send: '";
        // line 17
        ob_start(function () { return ''; });
        // line 18
        echo "          ";
        if (($context["is_guest"] ?? null)) {
            // line 19
            echo "          ajax_login_link
          ";
        } else {
            // line 21
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
            // line 22
            echo "          ";
        }
        // line 23
        echo "          ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "',
          mark_as_spam_btn: 'mark-as-span-";
        // line 24
        echo ($context["rand"] ?? null);
        echo "',
          mark_as_spam_link: 'mark-as-spam-";
        // line 25
        echo ($context["rand"] ?? null);
        echo "',
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
        return "helper_mark_as_spam_minibutton.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 25,  164 => 24,  159 => 23,  156 => 22,  134 => 21,  130 => 19,  127 => 18,  125 => 17,  120 => 16,  116 => 15,  108 => 14,  104 => 13,  79 => 10,  69 => 5,  46 => 4,  42 => 3,  35 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_mark_as_spam_minibutton.twig", "/home/mliadov/public_html/application/modules/spam/views/flatty/helper_mark_as_spam_minibutton.twig");
    }
}
