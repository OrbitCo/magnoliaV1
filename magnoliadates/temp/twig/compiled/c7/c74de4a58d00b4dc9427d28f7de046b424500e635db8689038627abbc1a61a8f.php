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

/* list_top_panel.twig */
class __TwigTemplate_7af6e975a9092087dadd15df747b6d302079d653185b6e589b22fbfbdf6effda extends \Twig\Template
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
        echo "<div class=\"b-winks__search\" id=\"mailbox_top_menu\">
    <div class=\"winks-search-form\">
        <ul>
            <li>
                <input type=\"text\" name=\"name_to_user\" id=\"user_text\" autocomplete=\"off\" class=\"form-control\" placeholder=\"";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_ph"        ,"winks"        ,        );
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
        echo "\">&nbsp;
                <script>
                    \$(function () {
                        loadScripts(
                                \"";
        // line 9
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"autocomplete_input.js"        ,"path"        ,        );
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
                                    user_autocomplete = new autocompleteInput({
                                        siteUrl: '";
        // line 12
        echo ($context["site_url"] ?? null);
        echo "',
                                        dataUrl: 'winks/ajax_get_users_data',
                                        id_text: 'user_text',
                                        id_hidden: 'user_hidden',
                                        rand: '";
        // line 16
        echo ($context["rand"] ?? null);
        echo "',
                                        format_callback: function (data) {
                                            return data.output_name;
                                        },
                                        select_callback: function (data) {
                                            winksObj.addUserToList(data);
                                            \$('#user_text').val('');
                                        }
                                    });
                                },
                                'user_autocomplete',
                                {async: false}
                                );
                    });
                </script>
            </li>
        </ul>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "list_top_panel.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 16,  87 => 12,  62 => 9,  36 => 5,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_top_panel.twig", "/home/mliadov/public_html/application/modules/winks/views/flatty/list_top_panel.twig");
    }
}
