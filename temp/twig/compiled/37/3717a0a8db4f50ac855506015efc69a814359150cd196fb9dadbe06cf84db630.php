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

/* list_payments.twig */
class __TwigTemplate_c3d284486d8378ad9f458d88442aee4f16b6d29750a000a31a8b7be144c2de87 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list_payments.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"x_content\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div id=\"menu\" class=\"btn-group\" data-toggle=\"buttons\">
                    <label class=\"btn btn-default";
        // line 8
        if ((($context["filter"] ?? null) == "all")) {
            echo " active";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           onclick=\"document.location.href='";
        // line 10
        echo ($context["site_url"] ?? null);
        echo "admin/payments/paymentsList/all/";
        echo ($context["payment_type_gid"] ?? null);
        echo "/";
        echo ($context["system_gid"] ?? null);
        echo "'\">
                        <input type=\"radio\" name=\"looking_user_type\">
                        ";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_payments_all"        ,"payments"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "all", []);
        echo ")
                    </label>
                    <label class=\"btn btn-default";
        // line 14
        if ((($context["filter"] ?? null) == "wait")) {
            echo " active";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           onclick=\"document.location.href='";
        // line 16
        echo ($context["site_url"] ?? null);
        echo "admin/payments/paymentsList/wait/";
        echo ($context["payment_type_gid"] ?? null);
        echo "/";
        echo ($context["system_gid"] ?? null);
        echo "'\">
                        <input type=\"radio\" name=\"looking_user_type\">
                        ";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_payments_wait"        ,"payments"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "wait", []);
        echo ")
                    </label>
                    <label class=\"btn btn-default";
        // line 20
        if ((($context["filter"] ?? null) == "approve")) {
            echo " active";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           onclick=\"document.location.href='";
        // line 22
        echo ($context["site_url"] ?? null);
        echo "admin/payments/paymentsList/approve/";
        echo ($context["payment_type_gid"] ?? null);
        echo "/";
        echo ($context["system_gid"] ?? null);
        echo "'\">
                        <input type=\"radio\" name=\"looking_user_type\">
                        ";
        // line 24
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_payments_approve"        ,"payments"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "approve", []);
        echo ")
                    </label>
                    <label class=\"btn btn-default";
        // line 26
        if ((($context["filter"] ?? null) == "decline")) {
            echo " active";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           onclick=\"document.location.href='";
        // line 28
        echo ($context["site_url"] ?? null);
        echo "admin/payments/paymentsList/decline/";
        echo ($context["payment_type_gid"] ?? null);
        echo "/";
        echo ($context["system_gid"] ?? null);
        echo "'\">
                        <input type=\"radio\" name=\"looking_user_type\">
                        ";
        // line 30
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_payments_decline"        ,"payments"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "decline", []);
        echo ")
                    </label>
                </div>
            </div>
            <div class=\"clearfix\"></div>
        </div>
        <div class=\"x_panel\">
            <div class=\"x_title\">
                <h2>";
        // line 38
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_filters"        ,"start"        ,        );
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
        echo "</h2>
                <ul class=\"nav navbar-right panel_toolbox\">
                    <li>
                        <a class=\"collapse-link\"><i class=\"fa fa-chevron-";
        // line 41
        if (( !($context["payment_type_gid"] ?? null) &&  !($context["system_gid"] ?? null))) {
            echo "down";
        } else {
            echo "up";
        }
        echo " cursor-pointer\"></i></a>
                    </li>
                </ul>
                <div class=\"clearfix\"></div>
            </div>
            <div class=\"x_content ";
        // line 46
        if (( !($context["payment_type_gid"] ?? null) &&  !($context["system_gid"] ?? null))) {
            echo "hide";
        }
        echo "\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <label class=\"col-md-2 col-sm-6 col-xs-12\">
                        ";
        // line 49
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_payment_type"        ,"payments"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-4 col-sm-6 col-xs-12\">
                        <select name=\"payment_type_gid\" class=\"form-control\" onchange=\"javascript: reload_this_page(this.value, '";
        // line 51
        echo ($context["system_gid"] ?? null);
        echo "');\">
                            <option value=\"all\">...</option>
                        ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["payment_types"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 54
            echo "                            <option value=\"";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" ";
            if ((($context["payment_type_gid"] ?? null) == $this->getAttribute($context["item"], "gid", []))) {
                echo "selected";
            }
            echo ">
                                ";
            // line 55
            echo $this->getAttribute($context["item"], "name", []);
            echo "
                            </option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "                        </select>
                    </div>
                    <label class=\"col-md-2 col-sm-6 col-xs-12\">
                        ";
        // line 61
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_billing_type"        ,"payments"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-4 col-sm-6 col-xs-12\">
                        <select name=\"system_gid\" class=\"form-control\" onchange=\"javascript: reload_this_page('";
        // line 63
        echo ($context["payment_type_gid"] ?? null);
        echo "', this.value);\">
                            <option value=\"all\">...</option>
                        ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["systems"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 66
            echo "                            <option value=\"";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" ";
            if ((($context["system_gid"] ?? null) == $this->getAttribute($context["item"], "gid", []))) {
                echo "selected";
            }
            echo ">
                                ";
            // line 67
            echo $this->getAttribute($context["item"], "name", []);
            echo "
                            </option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"x_content\">
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table\">
                <thead>
                    <tr class=\"headings\">
                        <th class=\"column-title\">";
        // line 79
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_user"        ,"payments"        ,        );
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
        echo "</th>
                        <th data-field=\"amount\" data-action=\"sorting\" class=\"column-title\">";
        // line 80
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_amount"        ,"payments"        ,        );
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
        echo "</th>
                        <th class=\"column-title\">";
        // line 81
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_type"        ,"payments"        ,        );
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
        echo "</th>
                        <th class=\"column-title\">";
        // line 82
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_billing_system"        ,"payments"        ,        );
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
        echo "</th>
                        <th data-field=\"date_add\" data-action=\"sorting\" class=\"column-title\">";
        // line 83
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_date"        ,"payments"        ,        );
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
        echo "</th>
                        <th class=\"column-title\">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["payments"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 89
            echo "                    ";
            $context["system_gid"] = $this->getAttribute($context["item"], "system_gid", []);
            // line 90
            echo "                    <tr class=\"even pointer\">
                        <td class=\"js-tooltip\" id=\"hide_";
            // line 91
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                          ";
            // line 92
            echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "output_name", []);
            echo "
                          <span id=\"span_hide_";
            // line 93
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" class=\" hide\">
                            <div class=\"tooltip-info x_panel\">
                                    ";
            // line 95
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "payment_data_formatted", []));
            foreach ($context['_seq'] as $context["param_id"] => $context["param"]) {
                // line 96
                echo "                                    <b>";
                echo $this->getAttribute($context["param"], "name", []);
                echo ":</b> ";
                echo $this->getAttribute($context["param"], "value", []);
                echo "<br>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['param_id'], $context['param'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            echo "                              </div>
                          </span>
                           ";
            // line 100
            echo " 
                        </td>
                        <td>
                            ";
            // line 103
            if (($this->getAttribute($context["item"], "operation_type", []) == "add")) {
                echo "+";
            } else {
                echo "-";
            }
            $module =             null;
            $helper =             'start';
            $name =             'currency_format_output';
            $params = array(["value" => $this->getAttribute(($context["item"] ?? null), "amount", []), "template" => "[abbr][value|dec_part:2|dec_sep:.|gr_sep:]"]            ,            );
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
            echo "                            
                        </td>   
                        <td>";
            // line 105
            echo $this->getAttribute($this->getAttribute($context["item"], "payment_data", []), "name", []);
            echo "</td>
                        <td>";
            // line 106
            echo $this->getAttribute($this->getAttribute(($context["systems"] ?? null), ($context["system_gid"] ?? null)), "name");
            echo "</td>
                        <td>";
            // line 107
            echo $this->getAttribute($context["item"], "date_add", []);
            echo "</td>
                        <td class=\"icons\">
                        ";
            // line 109
            if (($this->getAttribute($context["item"], "status", []) == "1")) {
                // line 110
                echo "                            <font class=\"success\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("payment_status_approved"                ,"payments"                ,                );
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
                echo "</font>
                        ";
            } elseif (($this->getAttribute(            // line 111
$context["item"], "status", []) == "-1")) {
                // line 112
                echo "                            <font class=\"error\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("payment_status_declined"                ,"payments"                ,                );
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
                echo "</font>
                        ";
            } else {
                // line 114
                echo "                            <div class=\"btn-group\">
                                <button type=\"button\" class=\"btn btn-primary\"
                                        onclick = \"";
                // line 116
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("payments"                ,"payments_btn_approve"                ,                );
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
                echo "document.location.href='";
                echo ($context["site_url"] ?? null);
                echo "admin/payments/payment_status/approve/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "'\">
                                            ";
                // line 117
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_payment_approve"                ,"payments"                ,                );
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
                // line 118
                echo "                                </button>
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                    <li onclick=\"";
                // line 125
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("payments"                ,"payments_btn_approve"                ,                );
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
                                        <a href=\"";
                // line 126
                echo ($context["site_url"] ?? null);
                echo "admin/payments/payment_status/approve/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                            ";
                // line 127
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_payment_approve"                ,"payments"                ,                );
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
                // line 128
                echo "                                        </a>
                                    </li>
                                    <li onclick=\"";
                // line 130
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("payments"                ,"payments_btn_decline"                ,                );
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
                                        <a href=\"";
                // line 131
                echo ($context["site_url"] ?? null);
                echo "admin/payments/payment_status/decline/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                            ";
                // line 132
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_payment_decline"                ,"payments"                ,                );
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
                // line 133
                echo "                                        </a>
                                    </li>
                                </ul>
                            </div>
                        ";
            }
            // line 138
            echo "                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 141
        echo "                </tbody>
            </table>
            ";
        // line 143
        $this->loadTemplate("@app/pagination.twig", "list_payments.twig", 143)->display($context);
        // line 144
        echo "        </div>
    </div>
</div>

";
        // line 148
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"easyTooltip.min.js"        ,        );
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
        // line 149
        echo "
<script type=\"text/javascript\">
    var filter = '";
        // line 151
        echo ($context["filter"] ?? null);
        echo "';
    var payment_type_gid = '";
        // line 152
        if (($context["payment_type_gid"] ?? null)) {
            echo ($context["payment_type_gid"] ?? null);
        } else {
            echo "all";
        }
        echo "';
    var system_gid = '";
        // line 153
        if (($context["system_gid"] ?? null)) {
            echo ($context["system_gid"] ?? null);
        } else {
            echo "all";
        }
        echo "';
    var order = '";
        // line 154
        echo ($context["order"] ?? null);
        echo "';
    var order_direction = '";
        // line 155
        echo ($context["order_direction"] ?? null);
        echo "';
    var reload_link = \"";
        // line 156
        echo ($context["site_url"] ?? null);
        echo "admin/payments/paymentsList/\";

    function reload_this_page(payment_type_gid, system_gid){
        var link = reload_link + filter + '/' + payment_type_gid + '/' + system_gid + '/' + order + '/' + order_direction;
        location.href=link;
    }

    \$(function(){
        \$(\".js-tooltip\").each(function(){
            \$(this).easyTooltip({
                useElement: 'span_'+\$(this).attr('id')
            });
        });
    });

    var moment;
</script>

";
        // line 174
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery-ui.custom.min.js"        ,        );
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
        // line 175
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<!-- Datatables -->
<script>
    var asInitVals = new Array();
    var sorting_fields = {
        amount: 1,
        date_add: 4    
    };
    \$(document).ready(function () {
        var oTable = \$('#users').dataTable({
            \"stateSave\": true,
            \"stateSaveCallback\": function (settings, data) {
                    localStorage.setItem('sorting_payments_fields', JSON.stringify(data));     
            },
            \"fnStateLoaded\": function (settings, data) {
                var sorting_payments_fields = JSON.parse(localStorage.getItem('sorting_payments_fields'))
                this.fnSort(sorting_payments_fields.order);
            },
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 195
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_all_column"        ,"start"        ,        );
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
        echo ":\",
                \"sEmptyTable\": \"";
        // line 196
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_payments"        ,"payments"        ,        );
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
            },
            \"columnDefs\": [
                {
                    'sortable': false,
                    'targets': [0,2,3,5]
                },
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bInfo\": false,
            \"dom\": 'T<\"clear\">lfrtip'
        });
        //oTable.fnSort([[5, 'asc'], [4, 'desc']]);

        \$(\"tfoot input\").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, \$(\"tfoot th\").index(\$(this).parent()));
        });
        \$(\"tfoot input\").each(function (i) {
            asInitVals[i] = this.value;
        });
        \$(\"tfoot input\").focus(function () {
            if (this.className == \"search_init\") {
                this.className = \"\";
                this.value = \"\";
            }
        });
        \$(\"tfoot input\").blur(function (i) {
            if (this.value == \"\") {
                this.className = \"search_init\";
                this.value = asInitVals[\$(\"tfoot input\").index(this)];
            }
        });
        oTable.fnSort([sorting_fields[order], order_direction.toLowerCase()]);
        \$('[data-action=sorting]').click(function(){
            var field = \$(this).data('field');
            var sortLinks = ";
        // line 233
        echo twig_jsonencode_filter(($context["sort_links"] ?? null));
        echo ";
            locationHref(sortLinks[field]);
        });
    });
</script>

";
        // line 239
        $this->loadTemplate("@app/footer.twig", "list_payments.twig", 239)->display($context);
    }

    public function getTemplateName()
    {
        return "list_payments.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1041 => 239,  1032 => 233,  973 => 196,  950 => 195,  925 => 175,  904 => 174,  883 => 156,  879 => 155,  875 => 154,  867 => 153,  859 => 152,  855 => 151,  851 => 149,  830 => 148,  824 => 144,  822 => 143,  818 => 141,  810 => 138,  803 => 133,  782 => 132,  776 => 131,  753 => 130,  749 => 128,  728 => 127,  722 => 126,  699 => 125,  690 => 118,  669 => 117,  642 => 116,  638 => 114,  613 => 112,  611 => 111,  587 => 110,  585 => 109,  580 => 107,  576 => 106,  572 => 105,  543 => 103,  538 => 100,  534 => 98,  523 => 96,  519 => 95,  514 => 93,  510 => 92,  506 => 91,  503 => 90,  500 => 89,  496 => 88,  469 => 83,  446 => 82,  423 => 81,  400 => 80,  377 => 79,  366 => 70,  357 => 67,  348 => 66,  344 => 65,  339 => 63,  315 => 61,  310 => 58,  301 => 55,  292 => 54,  288 => 53,  283 => 51,  259 => 49,  251 => 46,  239 => 41,  214 => 38,  182 => 30,  173 => 28,  166 => 26,  140 => 24,  131 => 22,  124 => 20,  98 => 18,  89 => 16,  82 => 14,  56 => 12,  47 => 10,  40 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_payments.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\payments\\views\\gentelella\\list_payments.twig");
    }
}
