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

/* helper_mark_as_spam_whitebutton.twig */
class __TwigTemplate_bb0f1d1cefdf2db83d3f84e2f71e8293c68b232299850e63de3066be8df37a94 extends \Twig\Template
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
    <ins class=\"far fa-flag edge w ";
        // line 5
        if (($context["is_send"] ?? null)) {
            echo "g";
        }
        if (($context["icon_size"] ?? null)) {
            echo " fa-";
            echo ($context["icon_size"] ?? null);
        }
        echo "\"
    id=\"";
        // line 6
        echo $this->getAttribute(($context["type"] ?? null), "gid", []);
        echo "_";
        echo ($context["object_id"] ?? null);
        echo "\"></ins>
</a>
<script>
  \$(function() {
    loadScripts(
      \"";
        // line 11
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
        // line 14
        echo ($context["site_root"] ?? null);
        echo "',
          use_form: ";
        // line 15
        if (($this->getAttribute(($context["type"] ?? null), "form_type", []) != "checkbox")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
          ";
        // line 16
        if ( !twig_test_empty(($context["is_spam_owner"] ?? null))) {
            echo "isOwner: true,";
        }
        // line 17
        echo "          is_send: '";
        echo ($context["is_send"] ?? null);
        echo "',
          error_is_send: '";
        // line 18
        ob_start(function () { return ''; });
        // line 19
        echo "          ";
        if (($context["is_guest"] ?? null)) {
            // line 20
            echo "          ajax_login_link
          ";
        } else {
            // line 22
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
            // line 23
            echo "          ";
        }
        // line 24
        echo "          ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "',
          mark_as_spam_btn: 'mark-as-span-";
        // line 25
        echo ($context["rand"] ?? null);
        echo "',
          mark_as_spam_link: 'mark-as-spam-";
        // line 26
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
        return "helper_mark_as_spam_whitebutton.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 26,  174 => 25,  169 => 24,  166 => 23,  144 => 22,  140 => 20,  137 => 19,  135 => 18,  130 => 17,  126 => 16,  118 => 15,  114 => 14,  89 => 11,  79 => 6,  69 => 5,  46 => 4,  42 => 3,  35 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_mark_as_spam_whitebutton.twig", "/home/mliadov/public_html/application/modules/spam/views/flatty/helper_mark_as_spam_whitebutton.twig");
    }
}
