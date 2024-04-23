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

/* helper_donate_view_block.twig */
class __TwigTemplate_ea094f94b54f8e93306511e9211b75abc80f09aaa1ea0ee9d7fd8c39b68443a7 extends \Twig\Template
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
        if ((($context["view_type"] ?? null) == "general")) {
            // line 2
            echo "    <div class=\"g-flatty-block\">
";
        }
        // line 4
        echo "<h2 class=\"b-title-control\">
    <span class=\"b-title-control__text\">";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_donate_view_block"        ,"start"        ,        );
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
    <div id=\"ajax_donate_link_menu_";
        // line 6
        echo ($context["rand"] ?? null);
        echo "\" class=\"b-title-control__action righted\">
        ";
        // line 7
        if ((($context["send_money"] ?? null) != "")) {
            // line 8
            echo "            <input type='button' id=\"donate_link_send_money\" class=\"btn btn-primary btn-sm\" value=\"";
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
            echo "\" title=\"";
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
            echo "\">
            <script>
                \$(function() {
                    loadScripts(
                        \"";
            // line 12
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("send_money"            ,"SendMoney.js"            ,"path"            ,            );
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
                            send_money = new SendMoney({
                                siteUrl: site_url,
                            });
                        },
                        ['send_money'],
                        {async: true}
                    );
                });

            </script>
        ";
        }
        // line 25
        echo "        ";
        if ((($context["send_vip"] ?? null) != "")) {
            // line 26
            echo "            <input type='button' id=\"donate_link_send_vip\" class=\"btn btn-primary btn-sm\" value=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_vip"            ,"send_vip"            ,            );
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
            echo "\" title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_vip"            ,"send_vip"            ,            );
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
            <script>
                \$(function(){
                    loadScripts(
                        \"";
            // line 30
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("send_vip"            ,"SendVip.js"            ,"path"            ,            );
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
                          send_vip = new SendVip({
                                siteUrl: site_url,
                            });
                        },
                        ['send_vip'],
                        {async: true}
                    );
                });
            </script>
        ";
        }
        // line 42
        echo "    </div>
</h2>

<div class=\"user-donate-history\">
    ";
        // line 46
        if (($context["transactions"] ?? null)) {
            // line 47
            echo "    <table class=\"table table-hover\">
        <thead>
            <tr>
                <th class=\"w100\">";
            // line 50
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("donate_amount"            ,"start"            ,            );
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
                <th class=\"w100\">";
            // line 51
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("donate_comment"            ,"start"            ,            );
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
                <th class='w200'><div class=\"righted\">";
            // line 52
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("donate_status"            ,"start"            ,            );
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
            echo "</div></th>
            </tr>
        </thead>
        ";
            // line 55
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["transactions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 56
                echo "        <tr>
            <td data-label=\"";
                // line 57
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("donate_amount"                ,"start"                ,                );
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
                ";
                // line 58
                if (($this->getAttribute($context["item"], "full_amount", []) == "")) {
                    echo "&nbsp;
                ";
                } elseif (($this->getAttribute(                // line 59
$context["item"], "full_amount", []) > 0)) {
                    // line 60
                    echo "                    <span dir=\"ltr\">
                        <font class=\"donate approve\">+";
                    // line 61
                    echo $this->getAttribute($context["item"], "amount", []);
                    echo " ";
                    echo $this->getAttribute(($context["currency"] ?? null), "abbr", []);
                    echo "</font>
                    </span>
                ";
                } else {
                    // line 64
                    echo "                    <span dir=\"ltr\">
                        <font class=\"donate decline\">";
                    // line 65
                    echo $this->getAttribute($context["item"], "full_amount", []);
                    echo " ";
                    echo $this->getAttribute(($context["currency"] ?? null), "abbr", []);
                    echo "</font>
                    </span>
                ";
                }
                // line 68
                echo "            </td>
            <td data-label=\"";
                // line 69
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("donate_comment"                ,"start"                ,                );
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
                ";
                // line 70
                echo $this->getAttribute($context["item"], "comment", []);
                echo "
            </td>
            <td id=\"status_";
                // line 72
                echo $this->getAttribute($context["item"], "rand", []);
                echo "\" class=\"righted\" data-label=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("donate_status"                ,"start"                ,                );
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
                ";
                // line 73
                if (($this->getAttribute($context["item"], "status", []) == "waiting")) {
                    // line 74
                    echo "                    ";
                    if (($this->getAttribute($context["item"], "approveLink", []) != "")) {
                        // line 75
                        echo "                        <button class='btn btn-primary btn-sm' onClick=\"
                                ";
                        // line 76
                        if (($this->getAttribute($context["item"], "membership_name", []) != "")) {
                            // line 77
                            echo "                                    send_vip.approveVipTransaction
                                ";
                        } else {
                            // line 79
                            echo "                                    send_money.approveMoneyTransaction
                                ";
                        }
                        // line 81
                        echo "                                    ('";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "','";
                        echo $this->getAttribute($context["item"], "rand", []);
                        echo "');\"
                                title=\"";
                        // line 82
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("donate_approve"                        ,"start"                        ,                        );
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
                            ";
                        // line 83
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("donate_approve"                        ,"start"                        ,                        );
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
                        // line 84
                        echo "                        </button>
                    ";
                    }
                    // line 86
                    echo "                    <div class='ml10 fright";
                    if (($this->getAttribute($context["item"], "approveLink", []) != "")) {
                        echo " mt5";
                    }
                    echo "'>
                        <a href=\"#\" onClick=\"
                            ";
                    // line 88
                    if (($this->getAttribute($context["item"], "membership_name", []) != "")) {
                        // line 89
                        echo "                                send_vip.declineVipTransaction
                            ";
                    } else {
                        // line 91
                        echo "                                send_money.declineMoneyTransaction
                            ";
                    }
                    // line 93
                    echo "                                ('";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "','";
                    echo $this->getAttribute($context["item"], "rand", []);
                    echo "');\"
                                title=\"";
                    // line 94
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("donate_decline"                    ,"start"                    ,                    );
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
                            <font class='donate decline'>";
                    // line 95
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("donate_decline"                    ,"start"                    ,                    );
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
                        </a>
                    </div>
                ";
                } elseif (($this->getAttribute(                // line 98
$context["item"], "status", []) == "approved")) {
                    // line 99
                    echo "                    <font class=\"donate approve\">";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("donate_approved"                    ,"start"                    ,                    );
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
                } elseif ((($this->getAttribute(                // line 100
$context["item"], "status", []) == "declined") && ($this->getAttribute($context["item"], "declined_by_me", []) == "1"))) {
                    // line 101
                    echo "                    <font class=\"donate decline\">";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("donate_declined_by_me"                    ,"start"                    ,                    );
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
                    // line 103
                    echo "                    <font class=\"donate decline\">";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("donate_declined"                    ,"start"                    ,                    );
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
                }
                // line 105
                echo "            </td>
        </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 108
            echo "    </table>
    ";
        } else {
            // line 110
            echo "        <div class=\"text-center\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("donate_no_data"            ,"start"            ,            );
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
    ";
        }
        // line 112
        echo "</div>

<script type=\"text/javascript\">
    \$(function(){
        \$('.user-donate-history [data-gid=\"donate\"]').each(function(){
            \$(this).attr('data-action', null);
        });
        \$('[data-gid=\"donate\"]').click(function(){
                if (\$(this).data('href')) {
                    location.href = \$(this).data('href');
                }
        });
    });
</script>

";
        // line 127
        if ((($context["view_type"] ?? null) == "general")) {
            // line 128
            echo "    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_donate_view_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  714 => 128,  712 => 127,  695 => 112,  670 => 110,  666 => 108,  658 => 105,  633 => 103,  608 => 101,  606 => 100,  582 => 99,  580 => 98,  555 => 95,  532 => 94,  525 => 93,  521 => 91,  517 => 89,  515 => 88,  507 => 86,  503 => 84,  482 => 83,  459 => 82,  452 => 81,  448 => 79,  444 => 77,  442 => 76,  439 => 75,  436 => 74,  434 => 73,  409 => 72,  404 => 70,  381 => 69,  378 => 68,  370 => 65,  367 => 64,  359 => 61,  356 => 60,  354 => 59,  350 => 58,  327 => 57,  324 => 56,  320 => 55,  295 => 52,  272 => 51,  249 => 50,  244 => 47,  242 => 46,  236 => 42,  202 => 30,  154 => 26,  151 => 25,  116 => 12,  68 => 8,  66 => 7,  62 => 6,  39 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_donate_view_block.twig", "/home/mliadov/public_html/application/modules/start/views/flatty/helper_donate_view_block.twig");
    }
}
