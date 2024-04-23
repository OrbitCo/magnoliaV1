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

/* account_menu_line.twig */
class __TwigTemplate_966d6b5ac81d1d52b8cb40a50c2894859fc33ce4cc6483dad4ddbf975111475c extends \Twig\Template
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
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("banners"        ,"memberships"        ,"access_permissions"        ,"users_payments"        ,"payments"        ,        );
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
        $context['is_module_installed'] = $result;
        // line 6
        if (($this->getAttribute(($context["is_module_installed"] ?? null), "users_payments", []) || $this->getAttribute(($context["is_module_installed"] ?? null), "payments", []))) {
            // line 7
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "access_permissions", [])) {
                // line 8
                echo "    ";
                ob_start(function () { return ''; });
                $module =                 null;
                $helper =                 'access_permissions';
                $name =                 'isMoreThanOneActiveGroup';
                $params = array(                );
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
                $context["is_one_group"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            }
            // line 10
            echo "<div class=\"col-xs-12\">
    <div class=\"contrasting-block account-block-menu\">
        <div class=\"center\">
            ";
            // line 13
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "access_permissions", [])) {
                // line 14
                echo "            <div class=\"menu-text-right col-xs-12 col-md-6\">
                <span class=\"user-description\">";
                // line 15
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_your_group"                ,"access_permissions"                ,                );
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
                echo ":</span>
                <span class=\"user-description\">[
                ";
                // line 17
                if ((twig_length_filter($this->env, ($context["is_one_group"] ?? null)) > 0)) {
                    // line 18
                    echo "                    <a href=\"";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("access_permissions"                    ,"index"                    ,                    );
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
                    echo "\" class=\"membership-link\">
                ";
                } else {
                    // line 20
                    echo "                    <span class=\"membership-title\">
                ";
                }
                // line 22
                echo "                ";
                $module =                 null;
                $helper =                 'access_permissions';
                $name =                 'getUserGroup';
                $params = array(["id_user" => ($context["user_id"] ?? null)]                ,                );
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
                echo "                ";
                if ((twig_length_filter($this->env, ($context["is_one_group"] ?? null)) > 0)) {
                    // line 24
                    echo "                    </a>
                ";
                } else {
                    // line 26
                    echo "                    </span>
                ";
                }
                // line 28
                echo "                ]</span>
                ";
                // line 29
                if ((twig_length_filter($this->env, ($context["is_one_group"] ?? null)) > 0)) {
                    // line 30
                    echo "                <span class=\"hidden-xs ml10 mr10\">
                    <a href=\"";
                    // line 31
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("access_permissions"                    ,"index"                    ,                    );
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
                    echo "\" class=\"link\">
                        ";
                    // line 32
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_change"                    ,"access_permissions"                    ,                    );
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
                    // line 33
                    echo "                    </a>
                </span>
                ";
                }
                // line 36
                echo "            </div>
            <div class=\"menu-text-left col-xs-12 col-md-6\">
            ";
            } else {
                // line 39
                echo "             <div class=\"col-xs-12\">
             ";
            }
            // line 41
            echo "                <span class=\"user-description\">
                    ";
            // line 42
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_on_account"            ,"users_payments"            ,            );
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
                    <span class=\"on-account\">";
            // line 43
            $module =             null;
            $helper =             'users';
            $name =             'onUserAccount';
            $params = array(["output_type" => "long"]            ,            );
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
                </span>
                ";
            // line 45
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "users_payments", [])) {
                // line 46
                echo "                    <span data-action=\"set-payment-system\" class=\"link hidden-xs ml10 mr10\">
                        ";
                // line 47
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("add_funds"                ,"users_payments"                ,                );
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
                // line 48
                echo "                    </span>
                    <span data-action=\"set-payment-system\" class=\"hidden-sm hidden-md hidden-lg hidden-xl pl5 pr5\">
                        <button onclick=\"";
                // line 50
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("user_account"                ,"add_funds"                ,                );
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
                echo "\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-plus\"></i></button>
                    </span>
                ";
            }
            // line 53
            echo "                ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "payments", [])) {
                // line 54
                echo "                    <span class=\"user-description\">
                        <a href=\"";
                // line 55
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"account"                ,"payments_history"                ,                );
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
                echo "\" class=\"history\">
                            ";
                // line 56
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("header_payments_history"                ,"users"                ,                );
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
                // line 57
                echo "                        </a>
                    </span>
                ";
            }
            // line 60
            echo "            </div>
        </div>
        <div class=\"clearfix\"></div>
    </div>
</div>
";
        }
        // line 66
        echo "<script>
    \$(function () {
        loadScripts(
            [\"";
        // line 69
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users_payments"        ,"UsersPayments.js"        ,"path"        ,        );
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
        echo "\"],
            function () {
                users_payments = new UsersPayments({
                    siteUrl: site_url
                });
            },
            ['users_payments'],
            {async: true}
        );
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "account_menu_line.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  417 => 69,  412 => 66,  404 => 60,  399 => 57,  378 => 56,  355 => 55,  352 => 54,  349 => 53,  324 => 50,  320 => 48,  299 => 47,  296 => 46,  294 => 45,  270 => 43,  247 => 42,  244 => 41,  240 => 39,  235 => 36,  230 => 33,  209 => 32,  186 => 31,  183 => 30,  181 => 29,  178 => 28,  174 => 26,  170 => 24,  167 => 23,  145 => 22,  141 => 20,  116 => 18,  114 => 17,  90 => 15,  87 => 14,  85 => 13,  80 => 10,  55 => 8,  53 => 7,  51 => 6,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "account_menu_line.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/account_menu_line.twig");
    }
}
