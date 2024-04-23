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

/* helper_update_account.twig */
class __TwigTemplate_8f2b921a89ea5b3853a0a0f81c1b72492c6626f81f724764d4bf3f4bd651b5b6 extends \Twig\Template
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
        echo "<div class=\"content-block\">
\t<div class=\"edit_block\">
        ";
        // line 3
        if (($context["billing_systems"] ?? null)) {
            // line 4
            echo "            <form action=\"";
            echo ($context["site_url"] ?? null);
            echo "users_payments/save_payment/\" method=\"post\"
                  role=\"form\" id=\"payment_form\">
                <div class=\"row\">
                    <input type=\"hidden\" value=\"\" name=\"system_gid\" id=\"system_gid\" />

                    <div class=\"col-md-12\">
                        <h3>";
            // line 10
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_select_payment_system"            ,"services"            ,            );
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
            echo "</h3>
                        <div class=\"row b-billing-systems\">
                            ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["billing_systems"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 13
                echo "                                ";
                if ($this->getAttribute($context["item"], "logo_url", [])) {
                    // line 14
                    echo "                                    <div class=\"col-xs-4 com-sm-4 col-md-2 col-lg-2 b-billing-systems__item\">
                                        <a class=\"b-billing-systems__link\"
                                           href=\"#\"
                                           data-gid=\"";
                    // line 17
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "\"
                                           data-img=\"";
                    // line 18
                    echo $this->getAttribute($context["item"], "logo_url", []);
                    echo "\"
                                           data-is_card=\"";
                    // line 19
                    echo $this->getAttribute($context["item"], "is_card", []);
                    echo "\"
                                           onclick=\"system_gid_change('";
                    // line 20
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "'); return false;\">
                                           <img class=\"img-responsive\" src=\"";
                    // line 21
                    echo $this->getAttribute($context["item"], "logo_url", []);
                    echo "\" title=\"";
                    echo $this->getAttribute($context["item"], "name", []);
                    echo "\" alt=\"";
                    echo $this->getAttribute($context["item"], "name", []);
                    echo "\">
                                        </a>
                                    </div>
                                ";
                }
                // line 25
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "                        </div>
                    </div>
                </div>

                <div class=\"row\">
                    <div class=\"col-xs-12 col-lg-4\">
                        <div class=\"r form-group hide\" id=\"operators\">
                            <h3>
                                ";
            // line 34
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_operator"            ,"users_payments"            ,            );
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
                            </h3>
                            <div id=\"operators_block\"></div>
                        </div>

                        <div class=\"form-group hide\" id=\"amount\">
                            <h3>
                                ";
            // line 41
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_enter_amount"            ,"users_payments"            ,            );
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
                            </h3>
                            <div id=\"amount_block\" class=\"col-xs-12\"></div>
                        </div>

                        <div class=\"r form-group hide\" id=\"details\">
                            <label>
                                ";
            // line 48
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_info_data"            ,"payments"            ,            );
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
                            </label>
                            <div id=\"details_block\"></div>
                        </div>

                        <div class=\"r hide\" id=\"errors\">
                            <i>";
            // line 54
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_operators"            ,"users_payments"            ,            );
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
            echo "</i>
                        </div>

                        <div class=\"clearfix\"></div>
                        <div class=\"hide\" id=\"card_form\">";
            // line 58
            $module =             null;
            $helper =             'payments';
            $name =             'cardForm';
            $params = array(            );
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
            echo "</div>


                        <button type=\"submit\" name=\"btn_payment_save\" class=\"btn btn-primary mr10\" value=\"1\">
                            ";
            // line 62
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_send"            ,"start"            ,            );
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
            // line 63
            echo "                        </button>
                        
                        ";
            // line 65
            if (($context["is_ajax"] ?? null)) {
                // line 66
                echo "                            <a href=\"javascript:void(0)\" id=\"cancel_payment\">
                                ";
                // line 67
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_cancel"                ,"start"                ,                );
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
                // line 68
                echo "                            </a>
                        ";
            }
            // line 70
            echo "                        
                    </div>
                </div>
            </form>

            ";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["billing_systems"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 76
                echo "                <div id=\"system_";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "\" class=\"hide\" data-tarifs=\"";
                echo $this->getAttribute($context["item"], "tarifs_type", []);
                echo "\">
                    <div id=\"operators_";
                // line 77
                echo $this->getAttribute($context["item"], "gid", []);
                echo "\">
                        <select name=\"operator\" class=\"form-control middle\">
                            ";
                // line 79
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "operators_data", []));
                foreach ($context['_seq'] as $context["operator_key"] => $context["operator_item"]) {
                    // line 80
                    echo "                                ";
                    if ($this->getAttribute($this->getAttribute($context["item"], "tarifs_status", []), $context["operator_key"], [], "array")) {
                        // line 81
                        echo "                                    <option value=\"";
                        echo $this->getAttribute($context["item"], "gid", []);
                        echo "_";
                        echo $context["operator_key"];
                        echo "\">
                                        ";
                        // line 82
                        echo $context["operator_item"];
                        echo "
                                    </option>
                                ";
                    }
                    // line 85
                    echo "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['operator_key'], $context['operator_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 86
                echo "                            ";
                if (($this->getAttribute($context["item"], "tarifs_type", []) == 2)) {
                    // line 87
                    echo "                                <option value=\"";
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "\">
                                    ";
                    // line 88
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("text_tarif_custom"                    ,"users_payments"                    ,                    );
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
                    // line 89
                    echo "                                </option>
                            ";
                }
                // line 91
                echo "                        </select>
                    </div>
                    ";
                // line 93
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "operators_data", []));
                foreach ($context['_seq'] as $context["operator_key"] => $context["operator_item"]) {
                    // line 94
                    echo "                        <div id=\"amount_";
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "_";
                    echo $context["operator_key"];
                    echo "\">
                            <select name=\"amount\" class=\"form-control middle\">
                                ";
                    // line 96
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "tarifs_data", []), $context["operator_key"], [], "array"));
                    foreach ($context['_seq'] as $context["_key"] => $context["tarif_item"]) {
                        // line 97
                        echo "                                    <option value=\"";
                        echo $context["tarif_item"];
                        echo "\">
                                        ";
                        // line 98
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'currency_format_output';
                        $params = array(["value" =>                         // line 99
($context["tarif_item"] ?? null), "cur_gid" => $this->getAttribute(                        // line 100
($context["base_currency"] ?? null), "gid", [])]                        ,                        );
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
                        // line 102
                        echo "                                    </option>
                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tarif_item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 104
                    echo "                                </select>
                        </div>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['operator_key'], $context['operator_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 107
                echo "                    <div id=\"amount_";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "\">
                        <div class=\"card-form mb10\">
                            <div class=\"input-group\">
                                <input type=\"text\" name=\"amount\" class=\"form-control\" pattern=\"\\d+(\\.\\d{2})?\">
                                <span class=\"input-group-addon\">";
                // line 111
                $module =                 null;
                $helper =                 'start';
                $name =                 'currency_output';
                $params = array(["cur_gid" => $this->getAttribute(($context["base_currency"] ?? null), "gid", [])]                ,                );
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
                echo "</span>
                            </div>
                        </div>
                    </div>
                    <div id=\"details_";
                // line 115
                echo $this->getAttribute($context["item"], "gid", []);
                echo "\">";
                echo $this->getAttribute($context["item"], "info_data", []);
                echo "</div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 118
            echo "
            <script>
                function system_gid_change(value) {
                    \$('#amount, #operators, #tarifs, #details, #errors').hide();
                    if(value){
                        /* set active element */
                        \$(\"[data-gid]\").each(function(index, value) {
                            \$(this).removeClass(\"active\");
                        });
                        var selectelement = \"[data-gid=\" + value + \"]\";
                        \$(selectelement).addClass(\"active\");
                        /* end set active element */

                        \$('#system_gid').val(value);
                        var tarifs_type =  \$('#system_'+value).data('tarifs');
                        let isCard = \$(selectelement).data('is_card');
                        if (isCard) {
                            \$('#card_form').removeClass('hide')
                        } else {
                            \$('#card_form').addClass('hide')
                        }


                        if (tarifs_type > 0) {
                            if(\$('#operators_'+value+' select').html()) {
                                var operators = \$('#operators_'+value).html();
                                var operator = \$('#operators').show()
                                                              .find('#operators_block')
                                                              .html(operators)
                                                              .find('select')
                                                              .trigger('change');
                                \$('#amount h3').html(\"";
            // line 149
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_choose_amount"            ,"users_payments"            ,            );
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
            echo "\");
                            } else {
                                \$('#errors').show();
                            }
                        }else{
                            var amount = \$('#amount_'+value).html();
                            \$('#amount').show().find('#amount_block').html(amount);
                        }
                        var details = \$('#details_' + value).html();
                        if(details.length) \$('#details').show().find('#details_block').html(details);
                    }
                }
                \$(function(){
                    \$('#operators').on('change', 'select', function(){
                        var amount = \$('#amount_'+this.value).html();
                        \$('#amount').show().find('#amount_block').html(amount);
                    });
                });
            </script>
        ";
        } else {
            // line 169
            echo "            <div class=\"r\">
                <i>";
            // line 170
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_empty_billing_system_list"            ,"users_payments"            ,            );
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
            echo "</i>
            </div>
        ";
        }
        // line 173
        echo "    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "helper_update_account.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  611 => 173,  586 => 170,  583 => 169,  541 => 149,  508 => 118,  497 => 115,  471 => 111,  463 => 107,  455 => 104,  448 => 102,  430 => 100,  429 => 99,  425 => 98,  420 => 97,  416 => 96,  408 => 94,  404 => 93,  400 => 91,  396 => 89,  375 => 88,  370 => 87,  367 => 86,  361 => 85,  355 => 82,  348 => 81,  345 => 80,  341 => 79,  336 => 77,  329 => 76,  325 => 75,  318 => 70,  314 => 68,  293 => 67,  290 => 66,  288 => 65,  284 => 63,  263 => 62,  237 => 58,  211 => 54,  183 => 48,  154 => 41,  125 => 34,  115 => 26,  109 => 25,  98 => 21,  94 => 20,  90 => 19,  86 => 18,  82 => 17,  77 => 14,  74 => 13,  70 => 12,  46 => 10,  36 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_update_account.twig", "/home/mliadov/public_html/application/modules/users_payments/views/flatty/helper_update_account.twig");
    }
}
