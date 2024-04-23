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

/* helper_services_buy_list_magazine.twig */
class __TwigTemplate_7ac37ea6cdbc3f9fbd8ee912e47d3c457e11d4292aa77eb6e737f454b219b805 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["services_block_services"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            echo "          
  ";
            // line 2
            if (($this->getAttribute($context["item"], "gid", []) != "ability_delete")) {
                // line 3
                echo "    ";
                if ((($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0") && twig_test_empty($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "date_expired", [])))) {
                    echo "                
        ";
                    // line 4
                    $context["item_is_bought"] = 1;
                    // line 5
                    echo "    ";
                } else {
                    // line 6
                    echo "        ";
                    $context["item_is_bought"] = 0;
                    // line 7
                    echo "    ";
                }
                // line 8
                echo "    <div id=\"service_buy_";
                echo $this->getAttribute($context["item"], "tpl_gid", []);
                if ((($context["item_is_bought"] ?? null) == 1)) {
                    echo "__";
                }
                echo "\" class=\"mag-services__item
        ";
                // line 9
                if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                    echo " mag-services__item_active";
                }
                // line 10
                echo "        ";
                if ((($context["item_is_bought"] ?? null) == 1)) {
                    echo " mag-services__unavailable";
                }
                echo "\">
        <div class=\"mag-services__icon\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
                // line 11
                echo $this->getAttribute($context["item"], "description", []);
                echo "\">
            <img class=\"mag-services__color\" onclick=\"";
                // line 12
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("left_menu_user"                ,"my_services"                ,                );
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
                echo "\" src=\"";
                echo ($context["base_url"] ?? null);
                echo ($context["img_folder"] ?? null);
                echo "icons/";
                echo $this->getAttribute($this->getAttribute($context["item"], "additional_settings", []), "icon_active", []);
                echo "\" alt=\"";
                echo $this->getAttribute($context["item"], "name", []);
                echo "\">
            <img class=\"mag-services__gray\" src=\"";
                // line 13
                echo ($context["base_url"] ?? null);
                echo ($context["img_folder"] ?? null);
                echo "icons/";
                echo $this->getAttribute($this->getAttribute($context["item"], "additional_settings", []), "icon_inactive", []);
                echo "\" alt=\"";
                echo $this->getAttribute($context["item"], "name", []);
                echo "\">            
            ";
                // line 14
                if ((($context["item_is_bought"] ?? null) == 0)) {
                    echo "                
                <div class=\"mag-services__plus\"><i class=\"fa fa-plus\"></i></div>
            ";
                }
                // line 17
                echo "            ";
                if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                    // line 18
                    echo "                <div class=\"mag-services__counter\">
                    ";
                    // line 19
                    if ($this->getAttribute($this->getAttribute($context["item"], "service_user_data", [], "any", false, true), "count", [], "any", true, true)) {
                        // line 20
                        echo "                        ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "count", []));
                        foreach ($context['_seq'] as $context["_key"] => $context["setting_options"]) {
                            // line 21
                            echo "                            <div>
                                ";
                            // line 22
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("field_count"                            ,"users"                            ,                            );
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
                            echo ":
                                ";
                            // line 23
                            echo $context["setting_options"];
                            echo "
                            </div>
                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['setting_options'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 26
                        echo "                    ";
                    } else {
                        // line 27
                        echo "                        ";
                        if (($this->getAttribute($context["item"], "gid", []) != "admin_approve")) {
                            // line 28
                            echo "                            <div>
                                ";
                            // line 29
                            $module =                             null;
                            $helper =                             'date_format';
                            $name =                             'tpl_date_diff_from_now';
                            $params = array($this->getAttribute($this->getAttribute(($context["item"] ?? null), "service_user_data", []), "date_expired", [])                            ,                            );
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
                            // line 30
                            echo "                            </div>
                        ";
                        }
                        // line 32
                        echo "                    ";
                    }
                    // line 33
                    echo "                </div>
            ";
                }
                // line 34
                echo "    
        </div>
        <div class=\"mag-services__title\">";
                // line 36
                echo $this->getAttribute($context["item"], "name", []);
                echo "</div>                               
    </div>
    <script>
        \$(function () {
            loadScripts(
                    [
                        \"";
                // line 42
                $module =                 null;
                $helper =                 'utils';
                $name =                 'jscript';
                $params = array(""                ,"available_view.js"                ,"path"                ,                );
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
                // line 43
                $module =                 null;
                $helper =                 'utils';
                $name =                 'jscript';
                $params = array("users"                ,"../views/flatty/js/users-avatar.js"                ,"path"                ,                );
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
                        ";
                // line 46
                echo $this->getAttribute($context["item"], "tpl_gid", []);
                echo "_available_view = new available_view({
                            siteUrl: site_url,
                            checkAvailableAjaxUrl: '";
                // line 48
                echo $this->getAttribute($this->getAttribute($context["item"], "additional_settings", []), "checkAvailableAjaxUrl", []);
                echo "',
                            buyAbilityAjaxUrl: '";
                // line 49
                echo $this->getAttribute($this->getAttribute($context["item"], "additional_settings", []), "buyAbilityAjaxUrl", []);
                echo "',
                            buyAbilityFormId: 'ability_form',
                            buyAbilitySubmitId: 'ability_form_submit',
                            formType: 'list',
                            success_request: function (message) {
                                error_object.show_error_block(message, 'success');
                            },
                            fail_request: function (message) {
                                error_object.show_error_block(message, 'error');
                            },
                        });
                        \$('#service_buy_";
                // line 60
                echo $this->getAttribute($context["item"], "tpl_gid", []);
                echo "').off('click').on('click', function (e) {
                            ";
                // line 61
                echo $this->getAttribute($context["item"], "tpl_gid", []);
                echo "_available_view.check_available();                            
                            return false;
                        });
                    },
                    ['";
                // line 65
                echo $this->getAttribute($context["item"], "gid", []);
                echo "_available_view'],
                   {async: false}
            );
        });
    </script>
  ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "<script>
\$(function() { 
    \$('[data-toggle=\"tooltip\"]').tooltip();    
});    
</script>";
    }

    public function getTemplateName()
    {
        return "helper_services_buy_list_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  319 => 72,  306 => 65,  299 => 61,  295 => 60,  281 => 49,  277 => 48,  272 => 46,  247 => 43,  224 => 42,  215 => 36,  211 => 34,  207 => 33,  204 => 32,  200 => 30,  179 => 29,  176 => 28,  173 => 27,  170 => 26,  161 => 23,  138 => 22,  135 => 21,  130 => 20,  128 => 19,  125 => 18,  122 => 17,  116 => 14,  107 => 13,  77 => 12,  73 => 11,  66 => 10,  62 => 9,  54 => 8,  51 => 7,  48 => 6,  45 => 5,  43 => 4,  38 => 3,  36 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_services_buy_list_magazine.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\services\\views\\flatty\\helper_services_buy_list_magazine.twig");
    }
}
