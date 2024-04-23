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

/* helper_mark_as_spam_drpdwn_li.twig */
class __TwigTemplate_0c61179bfe71d2acccddd6620dea04335317dcd65fd474fc1de3e92b56b3f4a9 extends \Twig\Template
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
        echo "<li class=\"user-menu-item\" data-id=\"";
        echo ($context["object_id"] ?? null);
        echo "\" data-type=\"";
        echo $this->getAttribute(($context["type"] ?? null), "gid", []);
        echo "\" id=\"mark-as-span-";
        echo ($context["rand"] ?? null);
        echo "\">
    <span class=\"user-menu-item\">
        <a href=\"javascript:void(0);\" class=\"link-r-margin ";
        // line 3
        if (($context["is_send"] ?? null)) {
            echo "link-inactive";
        }
        echo "\">
            ";
        // line 4
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
        // line 5
        echo "        </a>
    </span>
</li>
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
        return "helper_mark_as_spam_drpdwn_li.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 26,  160 => 25,  155 => 24,  152 => 23,  130 => 22,  126 => 20,  123 => 19,  121 => 18,  116 => 17,  112 => 16,  104 => 15,  100 => 14,  75 => 11,  67 => 5,  46 => 4,  40 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_mark_as_spam_drpdwn_li.twig", "/home/mliadov/public_html/application/modules/spam/views/flatty/helper_mark_as_spam_drpdwn_li.twig");
    }
}
