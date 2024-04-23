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

/* helper_search_form.twig */
class __TwigTemplate_80faa68cd3a777f95e8c69ef1fb6d8987b7d4f71cf1bd07498eed149b5d05bdc extends \Twig\Template
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
        echo "<script>
    selects = [];
    checkboxes = [];
    hlboxes = [];
    selectbox = [];
    radios = [];
    multiselects = [];
</script>
<div class=\"search-box ";
        // line 9
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo "\">
    <div id=\"search-form-block_";
        // line 10
        echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
        echo "\">
        ";
        // line 11
        echo ($context["form_block"] ?? null);
        echo "
    </div>
</div>
<script type=\"text/javascript\">
    \$(function() {
        loadScripts(
                [
                    \"";
        // line 18
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"search.js"        ,"path"        ,        );
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
                    \"";
        // line 19
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"selectbox.js"        ,"path"        ,        );
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
                    \"";
        // line 20
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"checkbox.js"        ,"path"        ,        );
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
                    \"";
        // line 21
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"hlbox.js"        ,"path"        ,        );
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
                    \"";
        // line 22
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"radio.js"        ,"path"        ,        );
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
                    \"";
        // line 23
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"multiselect.js"        ,"path"        ,        );
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
                ],
                function () {
                    window.";
        // line 26
        echo $this->getAttribute(($context["form_settings"] ?? null), "object", []);
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo " = new search({
                        siteUrl: '";
        // line 27
        echo ($context["site_url"] ?? null);
        echo "',
                        currentForm: '";
        // line 28
        echo $this->getAttribute(($context["form_settings"] ?? null), "object", []);
        echo "',
                        currentFormType: '";
        // line 29
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo "',
                        hide_popup: ";
        // line 30
        if ($this->getAttribute(($context["form_settings"] ?? null), "hide_popup", [])) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
                        view_type: '";
        // line 31
        echo $this->getAttribute(($context["form_settings"] ?? null), "view", []);
        echo "',
                        popup_autoposition: ";
        // line 32
        if ($this->getAttribute(($context["form_settings"] ?? null), "popup_autoposition", [])) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
                        userSearchUrl:  '";
        // line 33
        echo $this->getAttribute(($context["form_settings"] ?? null), "search_url", []);
        echo "',
                    });
                },
                '";
        // line 36
        echo $this->getAttribute(($context["form_settings"] ?? null), "object", []);
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo "',
                {async: false}
        );
    });
</script>

";
    }

    public function getTemplateName()
    {
        return "helper_search_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  241 => 36,  235 => 33,  227 => 32,  223 => 31,  215 => 30,  211 => 29,  207 => 28,  203 => 27,  198 => 26,  173 => 23,  150 => 22,  127 => 21,  104 => 20,  81 => 19,  58 => 18,  48 => 11,  44 => 10,  40 => 9,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_search_form.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\flatty\\helper_search_form.twig");
    }
}
