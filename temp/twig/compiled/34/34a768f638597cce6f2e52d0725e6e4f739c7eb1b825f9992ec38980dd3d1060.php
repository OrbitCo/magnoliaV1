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

/* helper_send_money_form.twig */
class __TwigTemplate_8acc5f57e339c45851e626f5a6be5839e0d325119dc01ff048688968826b3826 extends \Twig\Template
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
        echo "<div class=\"content-block load_content\">
    ";
        // line 2
        $context["user_callback"] = ('' === $tmp = "        function(variable, value, data){
            \$('#user_hidden').val(variable.toString()).change();
            \$('#user_text').val(value);
        }
    ") ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        echo "
    ";
        // line 9
        if (((($context["friends_count"] ?? null) == 0) && (($context["friends_only"] ?? null) != "to_all"))) {
            // line 10
            echo "        <h1>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_money"            ,"send_money"            ,            );
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
        <div class=\"inside send-money-find-friends\">
            <p>
                ";
            // line 13
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_money_only_friends"            ,"send_money"            ,            );
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
            // line 14
            echo "            </p>
        </div>
    ";
        } elseif (((        // line 16
($context["not_friend"] ?? null) == 1) && (($context["friends_only"] ?? null) != "to_all"))) {
            // line 17
            echo "        <h1>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_money"            ,"send_money"            ,            );
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
        <div class=\"inside send-money-find-friends\">
            <p>
                ";
            // line 20
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_money_only_friends"            ,"send_money"            ,            );
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
            echo "            </p>
        </div>
    ";
        } else {
            // line 24
            echo "
    <script>
        \$(function(){
            loadScripts(
                \"";
            // line 28
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"autocomplete_input.js"            ,"path"            ,            );
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
                function(){
                    user_autocomplete = new autocompleteInput({
                        siteUrl: '";
            // line 31
            echo ($context["site_root"] ?? null);
            echo "',
                        dataUrl: 'users/ajax_get_users_data',
                        id_text: 'user_text',
                        id_hidden: 'user_hidden',
                        user_id: ";
            // line 35
            echo ($context["user_id"] ?? null);
            echo ",
                        rand: '";
            // line 36
            echo ($context["rand"] ?? null);
            echo "',
                        format_callback: function(data){
                            return data.output_name;
                        }
                    });
                },
                'user_autocomplete'
            );
        });
        \$(function(){
            \$('#for_friends').unbind('click').click(function(){
                if (\$('#for_friends').prop('checked')) {
                    \$('#friend_list').removeClass('hide');
                    \$('#user_text').addClass('hide');
                } else {
                    \$('#user_text').removeClass('hide');
                    \$('#friend_list').addClass('hide');
                }
            });
        });
        \$(function(){
            \$('#amount').unbind('input').on('input', function(){
                if (\$('#amount').val() > 0) {
                    \$('#output').text(function(){
                        var out = parseFloat(\$('#amount').val()) +
                            ";
            // line 61
            if ((($context["koef"] ?? null) == 1)) {
                // line 62
                echo "                            parseFloat(";
                echo ($context["transfer_fee"] ?? null);
                echo ");
                            ";
            } else {
                // line 64
                echo "                            (parseFloat(\$('#amount').val())*";
                echo ($context["koef"] ?? null);
                echo ");
                            ";
            }
            // line 66
            echo "                        return out;
                    });
                } else {
                    \$('#output').text(0);
                }
            });
            \$('#amount').trigger('input');
        });
    </script>
    <div class=\"send-money-form-wrapper\">
        <h1>";
            // line 76
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_money"            ,"send_money"            ,            );
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
        <form id=\"send_form\" class=\"send-money-form\" method=\"post\" class=\"\" action=\"";
            // line 77
            echo ($context["site_url"] ?? null);
            echo "send_money/confirm\">
            <div class=\"row\">
                <div class=\"col-md-5 send-money-select-user\">
                    <div class=\"form-group\">
                        <label>";
            // line 81
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("admin_settings_to_whom"            ,"send_money"            ,            );
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
            echo "</label>
                        ";
            // line 82
            if (((($context["friends_count"] ?? null) != 0) && (($context["not_friend"] ?? null) != 1))) {
                // line 83
                echo "                        <select id=\"friend_list\" name=\"friend\" class=\"form-control";
                if ((($context["friends_only"] ?? null) == "to_all")) {
                    echo " hide ";
                }
                echo "\">
                            ";
                // line 84
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["friends_list"] ?? null));
                foreach ($context['_seq'] as $context["friend_id"] => $context["item"]) {
                    // line 85
                    echo "                            <option value=\"";
                    echo $context["friend_id"];
                    echo "\" ";
                    if (($this->getAttribute(($context["user_selected"] ?? null), "id", []) == $context["friend_id"])) {
                        echo "selected";
                    }
                    echo ">
                                ";
                    // line 86
                    echo $context["item"];
                    echo "
                            </option>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['friend_id'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 89
                echo "                        </select>
                        ";
            }
            // line 91
            echo "                        ";
            if ((($context["friends_only"] ?? null) == "to_all")) {
                // line 92
                echo "                            <input type=\"text\" id=\"user_text\" name=\"user_text\" placeholder=\"\" class=\"form-control\"
                                   value=\"";
                // line 93
                if ( !twig_test_empty(($context["user_selected"] ?? null))) {
                    echo $this->getAttribute(($context["user_selected"] ?? null), "output_name", []);
                }
                echo "\">
                        ";
            } else {
                // line 95
                echo "                            <span id=\"user_text\" class=\"hide\"></span>
                        ";
            }
            // line 97
            echo "                        <input type=\"hidden\" name=\"id_user\" id=\"user_hidden\" value=\"";
            echo $this->getAttribute(($context["user_selected"] ?? null), "id", []);
            echo "\">
                    </div>
                </div>
                ";
            // line 100
            if (((($context["friends_count"] ?? null) != 0) && (($context["not_friend"] ?? null) != 1))) {
                // line 101
                echo "                    ";
                if ((($context["friends_only"] ?? null) == "to_all")) {
                    // line 102
                    echo "                    <div class=\"col-md-5 send-money-for-friends\">
                        <label for=\"for_friends\" class=\"checkbox-inline\">
                            <input type=\"checkbox\" id=\"for_friends\">";
                    // line 104
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("admin_settings_friends"                    ,"send_money"                    ,                    );
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
                    // line 105
                    echo "                        </label>
                    </div>
                    ";
                }
                // line 108
                echo "                ";
            }
            // line 109
            echo "            </div>
            <div class=\"form-group row send-money-amount-input\">
                <div class=\"col-md-5\">
                    <label>";
            // line 112
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_money_amount"            ,"send_money"            ,            );
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
            echo ", ";
            echo ($context["cur_currency"] ?? null);
            echo "</label>
                    <input type=\"number\" min=\"1\" name=\"amount\" id=\"amount\" pattern=\"\\d+(\\.\\d{2})?\" value=\"1\"
                           placeholder=\"\" class=\"form-control\">
                </div>
            </div>
            ";
            // line 117
            if ((($context["use_fee"] ?? null) == "use")) {
                // line 118
                echo "            <div class='mt5 mb5'>
                <div class='fleft'>";
                // line 119
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("send_money_transfer_live"                ,"send_money"                ,                );
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
                echo "&nbsp;
                <div id='output' pattern='\\d+(\\.\\d{2})?'>0</div>
                <span>&nbsp;";
                // line 121
                echo ($context["cur_currency"] ?? null);
                echo " (";
                echo ($context["transfer_fee"] ?? null);
                echo " ";
                if ((($context["koef"] ?? null) == "1")) {
                    echo ($context["cur_currency"] ?? null);
                } else {
                    echo ($context["currency"] ?? null);
                }
                echo ")</span>
                </div>
            </div>
            <div class=\"clr\"></div>
            ";
            }
            // line 126
            echo "            <div class=\"form-group send-money-btn\">
                <button type=\"submit\" form=\"send_form\" name=\"btn_send_money_save\"
                    class=\"btn btn-primary\" value=\"1\">
                    ";
            // line 129
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_money"            ,"send_money"            ,            );
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
            // line 130
            echo "                </button>
            </div>
        </form>
    </div>
    ";
        }
        // line 135
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "helper_send_money_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  507 => 135,  500 => 130,  479 => 129,  474 => 126,  458 => 121,  434 => 119,  431 => 118,  429 => 117,  400 => 112,  395 => 109,  392 => 108,  387 => 105,  366 => 104,  362 => 102,  359 => 101,  357 => 100,  350 => 97,  346 => 95,  339 => 93,  336 => 92,  333 => 91,  329 => 89,  320 => 86,  311 => 85,  307 => 84,  300 => 83,  298 => 82,  275 => 81,  268 => 77,  245 => 76,  233 => 66,  227 => 64,  221 => 62,  219 => 61,  191 => 36,  187 => 35,  180 => 31,  155 => 28,  149 => 24,  144 => 21,  123 => 20,  97 => 17,  95 => 16,  91 => 14,  70 => 13,  44 => 10,  42 => 9,  39 => 8,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_send_money_form.twig", "/home/mliadov/public_html/application/modules/send_money/views/flatty/helper_send_money_form.twig");
    }
}
